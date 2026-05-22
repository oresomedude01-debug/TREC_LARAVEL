# Gallery Images - Google Drive Integration Guide

## Quick Start

You have 8 TSCC 2025 event images ready to be added to the gallery. Follow these steps:

### Step 1: Get Direct Download Links from Google Drive

For each image in your Google Drive folder (https://drive.google.com/drive/folders/1C3V-VOhKXqtqHQiOYZ9KwoptqOz62l-L):

1. Right-click the image file (e.g., IMG_7036.JPG)
2. Select **"Get link"** or **"Share"**
3. Copy the sharing link (example: `https://drive.google.com/file/d/ABC123xyz/view`)
4. Convert it to a direct download link by extracting the FILE_ID and using this format:
   ```
   https://drive.google.com/uc?export=view&id=ABC123xyz
   ```

### Step 2: Update the Seeder

Edit `database/seeders/AddTSCCGalleryImagesSeeder.php` and replace the placeholder IDs with your actual file IDs:

**Before:**
```php
'image_path' => 'https://drive.google.com/uc?export=view&id=1placeholder1',
```

**After:**
```php
'image_path' => 'https://drive.google.com/uc?export=view&id=ACTUAL_FILE_ID',
```

### Step 3: Run the Seeder

Once you've updated all 8 image URLs:

```bash
cd c:\xampp\htdocs\TREC_Laravel
php artisan db:seed --class=AddTSCCGalleryImagesSeeder
```

### Step 4: View the Gallery

Visit http://localhost:8000/gallery to see your images displayed.

---

## Image Files Available in Your Google Drive Folder

The following JPG images are available in your Google Drive:

- IMG_7036.JPG (6 MB)
- IMG_7037.JPG (5.8 MB)
- IMG_7038.JPG (4.9 MB)
- IMG_7039.JPG (5.9 MB)
- IMG_7040.JPG (5.8 MB)
- IMG_7041.JPG (6 MB)
- IMG_7042.JPG (6 MB)
- IMG_7043.JPG (6.1 MB)

---

## Direct Links Template

Use this template to quickly build your direct download links:

```
https://drive.google.com/uc?export=view&id=[FILE_ID]
```

---

## Troubleshooting

**Images not loading?**
- Ensure the Google Drive file is shared publicly or with appropriate permissions
- Double-check the FILE_ID in the URL
- Try accessing the URL directly in your browser to verify it works

**Seeder not working?**
- Make sure you're in the Laravel project directory
- Check that all image URLs are properly formatted
- Run `php artisan migrate:refresh --seed` to reset if needed

---

## Admin Panel

After seeding, you can manage gallery images through:
- **View**: http://localhost:8000/admin/gallery
- **Add/Edit**: Currently requires admin authentication (upcoming feature)
