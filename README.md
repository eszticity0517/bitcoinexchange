Prerequisites

1. For php code edition, I used Visual Studio Code (https://code.visualstudio.com/)
2. Visual C++ Redistributable for Visual Studio
3. You need php installed on your computer. You can acquire it from http://php.net/
4. If you use windows, visit this: https://windows.php.net/download/
5. In this case, you will need Visual C++ Redistributable for Visual Studio 2017.
Link could be found on the left bar of the Windows download page.
6. If you chose Visual Studio Code to work with, you have to add this to user settings:
"php.validate.executablePath": "C:\\php\\php.exe"
7. User settings are in File -> Preferences -> Settings
8. You will need extensions like MySQL management tool by Jun Han (https://marketplace.visualstudio.com/items?itemName=formulahendry.vscode-mysql)
and vscode-database by Bajdzis (https://marketplace.visualstudio.com/items?itemName=bajdzis.vscode-database)
10. If your don't have any server to connect to, I recommend to use Wamp Server on Windows (https://sourceforge.net/projects/wampserver/)
and Mamp Server (https://www.mamp.info/en/) on Mac

Installing
1. First of all, you will need 3 datatables. Run init.php from index.php once.

Usage
1. With WampServer usage, I ran my program from terminal like this: C:\wamp\bin\php\php7.2.4\php.exe -S localhost:8000

Notes
1. After click "Submit", request takes a few seconds. Be patient :)
