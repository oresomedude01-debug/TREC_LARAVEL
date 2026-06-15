@echo off
title TREC Queue Worker
echo =====================================================
echo  TREC Laravel Queue Worker - Keep this window open!
echo =====================================================
echo.

:loop
echo [%date% %time%] Starting queue worker...
php "C:\xampp\htdocs\TREC_Laravel\artisan" queue:work database --sleep=3 --tries=3 --max-time=3600
echo.
echo [%date% %time%] Worker stopped or crashed. Restarting in 5 seconds...
timeout /t 5 /nobreak >nul
goto loop
