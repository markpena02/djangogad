@echo off
REM Set path to your virtual environment activate script
set VENV_PATH=venv\Scripts\activate

REM Check if venv folder exists
IF NOT EXIST %VENV_PATH% (
    echo Creating virtual environment...
    python -m venv venv
) 

REM Activate the virtual environment
call %VENV_PATH%

REM Install or upgrade pip itself
python -m pip install --upgrade pip

REM Install the requirements
pip install -r requirements.txt

REM Start Django server
python manage.py runserver
