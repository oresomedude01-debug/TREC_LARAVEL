# Self-elevate if not already running as Administrator
if (-NOT ([Security.Principal.WindowsPrincipal][Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]"Administrator")) {
    Write-Host "Requesting administrator privileges..."
    Start-Process PowerShell -ArgumentList "-ExecutionPolicy Bypass -File `"$PSCommandPath`"" -Verb RunAs
    exit
}

$taskName = "TREC-Laravel-Queue-Worker"
$batchFile = "C:\xampp\htdocs\TREC_Laravel\queue-worker.bat"

Write-Host "====================================================="
Write-Host " Installing TREC Laravel Queue Worker"
Write-Host " (Running elevated as Administrator)"
Write-Host "====================================================="

# Remove old task if exists
$existing = Get-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue
if ($existing) {
    Write-Host "Removing old task..."
    Stop-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue
    Unregister-ScheduledTask -TaskName $taskName -Confirm:$false
}

# Action: run the self-restarting batch file
$action = New-ScheduledTaskAction `
    -Execute "cmd.exe" `
    -Argument "/c `"$batchFile`"" `
    -WorkingDirectory "C:\xampp\htdocs\TREC_Laravel"

# Triggers: at system startup
$triggerBoot = New-ScheduledTaskTrigger -AtStartup

# Run as SYSTEM — no password needed, survives reboots
$principal = New-ScheduledTaskPrincipal `
    -UserId "SYSTEM" `
    -LogonType ServiceAccount `
    -RunLevel Highest

# Settings: no timeout, restart automatically if it crashes
$settings = New-ScheduledTaskSettingsSet `
    -ExecutionTimeLimit (New-TimeSpan -Hours 0) `
    -RestartCount 99 `
    -RestartInterval (New-TimeSpan -Minutes 1) `
    -MultipleInstances IgnoreNew

# Register the task
Register-ScheduledTask `
    -TaskName $taskName `
    -Action $action `
    -Trigger $triggerBoot `
    -Principal $principal `
    -Settings $settings `
    -Description "Persistent Laravel queue worker for TREC email delivery. Auto-restarts on crash." `
    -Force | Out-Null

if ($LASTEXITCODE -eq 0 -or (Get-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue)) {
    # Start it immediately
    Start-ScheduledTask -TaskName $taskName -ErrorAction SilentlyContinue

    Write-Host ""
    Write-Host "==========================================="
    Write-Host " SUCCESS! Queue worker installed & running."
    Write-Host "==========================================="
    Write-Host ""
    Write-Host "  Starts automatically at every Windows boot"
    Write-Host "  Restarts within 1 minute if it ever crashes"
    Write-Host "  Running silently in the background now"
    Write-Host ""
    Write-Host "Manage via Task Scheduler or PowerShell:"
    Write-Host "  Check status : Get-ScheduledTask -TaskName '$taskName'"
    Write-Host "  Stop worker  : Stop-ScheduledTask  -TaskName '$taskName'"
    Write-Host "  Start worker : Start-ScheduledTask -TaskName '$taskName'"
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "ERROR: Registration failed. Check Task Scheduler manually."
}

Read-Host "Press Enter to close"
