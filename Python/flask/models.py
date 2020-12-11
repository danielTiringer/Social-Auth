from flask_login import UserMixin
from flask_dance.consumer.backend.sqla import OAuthConsumerMixin
from . import db

class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key = True)
    name = db.Column(db.String(255))
    email = db.Column(db.String(100), unique = True)
    password = db.Column(db.String(100))

class OAuth(OAuthConsumerMixin, db.Model):
    user_id = db.Column(db.Integer, db.ForeignKey(User.id))
    user = db.relationship(User)
