/**
 * ============================================================
 *  TREC Nigeria — Google Sheets Contact Form Receiver
 *  Google Apps Script (paste into Tools > Script Editor)
 * ============================================================
 *
 *  SETUP STEPS:
 *  1. Open your Google Sheet
 *  2. Click Extensions > Apps Script
 *  3. Paste this entire file, replacing any existing code
 *  4. Click Save (💾)
 *  5. Click Deploy > New Deployment
 *     - Type: Web App
 *     - Execute as: Me
 *     - Who has access: Anyone
 *  6. Click Deploy, then copy the Web App URL
 *  7. Paste the URL into your Laravel .env:
 *       GOOGLE_SHEETS_URL=https://script.google.com/macros/s/YOUR_ID/exec
 *  8. Run: php artisan config:clear
 * ============================================================
 */

// ── Configuration ────────────────────────────────────────────
const SHEET_NAME = 'Contact Submissions'; // Tab name in your Google Sheet

// Column headers (order matters — must match doPost logic below)
const HEADERS = [
  'Timestamp',
  'First Name',
  'Last Name',
  'Full Name',
  'Email',
  'Phone',
  'Organisation',
  'Service Interest',
  'Message',
  'Source URL',
];
// ─────────────────────────────────────────────────────────────

/**
 * Handles GET requests — useful for testing the deployment is live.
 */
function doGet(e) {
  return ContentService
    .createTextOutput(JSON.stringify({ status: 'ok', message: 'TREC Sheets receiver is live.' }))
    .setMimeType(ContentService.MimeType.JSON);
}

/**
 * Handles POST requests from Laravel ContactController.
 * Appends one row per submission to the configured sheet.
 */
function doPost(e) {
  try {
    const ss    = SpreadsheetApp.getActiveSpreadsheet();
    let   sheet = ss.getSheetByName(SHEET_NAME);

    // Auto-create the sheet with headers if it doesn't exist
    if (!sheet) {
      sheet = ss.insertSheet(SHEET_NAME);
      sheet.appendRow(HEADERS);
      // Style the header row
      const headerRange = sheet.getRange(1, 1, 1, HEADERS.length);
      headerRange.setBackground('#D82D37')
                 .setFontColor('#ffffff')
                 .setFontWeight('bold')
                 .setFontSize(11);
      sheet.setFrozenRows(1);
    }

    // Parse incoming data (Laravel sends as application/x-www-form-urlencoded)
    const params = e.parameter || {};

    const firstName  = params.first_name       || '';
    const lastName   = params.last_name        || '';
    const email      = params.email            || '';
    const phone      = params.phone            || '';
    const org        = params.organisation     || '';
    const service    = params.service_interest || '';
    const message    = params.message          || '';
    const sourceUrl  = params.source_url       || '';
    const submittedAt = params.submitted_at    || new Date().toISOString();

    // Append data row
    sheet.appendRow([
      submittedAt,           // Timestamp
      firstName,             // First Name
      lastName,              // Last Name
      `${firstName} ${lastName}`.trim(), // Full Name
      email,                 // Email
      phone,                 // Phone
      org,                   // Organisation
      service,               // Service Interest
      message,               // Message
      sourceUrl,             // Source URL
    ]);

    // Auto-resize columns for readability
    sheet.autoResizeColumns(1, HEADERS.length);

    return ContentService
      .createTextOutput(JSON.stringify({ status: 'success', message: 'Row appended.' }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (err) {
    return ContentService
      .createTextOutput(JSON.stringify({ status: 'error', message: err.toString() }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}
