from flask import Flask, render_template
server = Flask(__name__)

@server.route('/')
def hello():
    return render_template('home.html')

if __name__ == '__main__':
   server.run(debug=True, host='0.0.0.0', port=5000)