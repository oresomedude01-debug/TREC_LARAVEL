:: Right-click this file → "Run as Administrator"
:: This installs the TREC queue worker as a Windows service that runs at startup.

powershell -ExecutionPolicy Bypass -File "%~dp0install-queue-worker.ps1"
pause
