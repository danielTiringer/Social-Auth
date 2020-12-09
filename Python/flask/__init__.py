import os
from flask import Flask, redirect, url_for
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager
from flask_dance.contrib.github import make_github_blueprint, github

db = SQLAlchemy()

def create_app():
    app = Flask(__name__)

    app.config['SECRET_KEY'] = 'superdupersecretkey'
    app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:password@db/db'
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

    db.init_app(app)

    login_manager = LoginManager()
    login_manager.login_view = 'auth.login'
    login_manager.init_app(app)

    from .models import User

    @login_manager.user_loader
    def load_user(user_id):
        return User.query.get(int(user_id))

    from .auth import auth as auth_blueprint
    app.register_blueprint(auth_blueprint)

    from .main import main as main_blueprint
    app.register_blueprint(main_blueprint)

    github_blueprint = make_github_blueprint(
        client_id=os.environ.get('GITHUB_OAUTH_CLIENT_ID'),
        client_secret=os.environ.get('GITHUB_OAUTH_CLIENT_SECRET')
    )
    app.register_blueprint(github_blueprint, url_prefix='/github_login')

    @app.route('/github')
    def github_login():
        if not github.authorized:
            return redirect(url_for('github.login'))

        account_info = github.get('/user')

        if account_info.ok:
            account_info_json = account_info.json()
            return "You are @{login} on Github".format(login=account_info.json()["login"])

            return redirect(url_for('main.profile'))

        return redirect(url_for('auth.login'))

    return app
