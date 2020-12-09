# Docker Python App

Python development Environment.

### Designate Python version and required dependencies

Add all required dependencies with their version numbers to `requirements.txt`.
These will be installed when the *Dockerfile* executes the `RUN pip install -r
requirements.txt` command.

### Change ownership of Python project files to current user

Because containers are run as `root` in Linux, the files created by any command executed through Docker are _owned_ by `root`. To allow local editing of the application files, change the owner of the files to the current user:

``` bash
sudo chown -R $USER:$USER .
```

### Run the local Python development server

Start the container:

``` bash
docker-compose up -d
```

And visit [`http://localhost:5000`](http://localhost:5000). The default Python homepage should show up.

### Use Python commands and the Python CLI

In order to run commands, spin up a temp container, and issue commands:

``` bash
docker-compose run --rm python python manage.py createsuperuser
```

To enter the shell:

``` bash
docker-compose run --rm python python
```

To exit the shell:

``` python
exit()
```

### Migrations

If migrations are needed, enter into the command line:

``` bash
docker-compose run --rm python python
```
Then go to the root directory, import the required modules, and run commands:

``` python
import os
os.chdir('/')
from app import db, create_app
db.create_all(app=create_app())
```

### If using a database, update `projectfolder/settings.py`

The default database is SQLite. If something else is used:
* Install the desired driver by adding it to requirements.txt and rebuilding the
  container
* Update the `settings.py` file with the database details. `host` refers to the
  container's identification in `docker-compose.yml`

``` python
# settings.py
   
DATABASES = {
    'default': {
        'ENGINE': 'mysql',
        'NAME': 'database',
        'USER': 'user',
        'PASSWORD': 'password',
        'HOST': 'mysql',
        'PORT': 3308,
    }
}
```
