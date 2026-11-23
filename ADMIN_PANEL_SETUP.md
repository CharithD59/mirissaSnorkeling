# Admin Panel – Setup & Guide

The admin panel lives at **`/admin`** (e.g. http://127.0.0.1:8000/admin).

## 1. Install (one time)

Run these from the project folder:

```bash
php artisan migrate        # adds the admin tables/columns (existing data is kept)
php artisan db:seed        # creates the 2 admin users + imports current packages & gallery photos
php artisan view:clear
```

Default logins (please change the passwords after the first sign-in under **My Profile**):

| Username | Password |
|----------|----------|
| admin    | 123      |
| admin1   | 123      |

You can also sign in with the user's email address.

### What the migrations do
* `tbl_booking_det` / `tbl_contact_det` – **only add** new columns (`status`, `admin_notes`, `total_amount`, `package_id`, `is_read`, `replied_at`, …). Existing bookings and inquiries are kept and start as **Pending**. If a table has no primary key, an `id` column is added.
* New tables: `packages`, `site_settings`, `gallery_images`, `contact_replies` (and `whatsapp_click_logs` if missing).
* `users` – adds `username`, `role`, `is_active`, `last_login_at`.
* The default Laravel migrations now skip tables that already exist, so `migrate` is safe on the live database.
* Seeders never overwrite: admins are only created if missing; packages/gallery are imported only when those tables are empty.

## 2. Features

| Area | What you can do |
|------|-----------------|
| **Dashboard** | Totals for bookings (pending / confirmed / completed / cancelled), inquiries, upcoming guests, confirmed revenue, WhatsApp clicks; 12-month trend chart, status breakdown, most-booked services, recent bookings, upcoming tours, latest inquiries. |
| **Bookings** | Search (name, email, phone, `BK-00012`), filter by status / service / tour-date range, sort, CSV export, view details, create / edit / delete, quick status change, optional status email to the customer, internal notes, amount. |
| **Inquiries** | Status tabs (Pending / Replied / Closed), search & date filter, unread highlighting, reply by email from the panel (reply history is stored), call / WhatsApp shortcuts, “Create booking” pre-filled from the inquiry. |
| **Packages** | Add / edit / delete tours, price or custom price label, features list, duration, pickup time, image upload, “Read More” link, display order, show on homepage, **availability** (on/off, max guests per day, blocked dates). The website booking form only lists available packages and refuses bookings for blocked or full dates. |
| **Website Content** | Edit texts, images, videos and links for every homepage section, header/footer contact details, social links, booking page and gallery page; show/hide homepage sections; reset any field to its original text. |
| **Gallery** | Upload multiple photos, set title/caption/category, choose homepage and/or gallery page, hide, reorder, replace and delete. |
| **Admin Users / My Profile** | Add / disable / delete admins, change your own name, email and password. |

## 3. Design & usability

* **Light / Dark / Auto theme** – toggle with the sun/moon button in the top bar, or pick Light, Dark or Auto (follows the device) in the user menu or under *Account & Appearance*. The choice is saved in the browser and applied before the page paints, so there is no flash on refresh.
* **Collapsible sidebar** – the « button shrinks it to an icon rail (with tooltips); the choice is remembered. On tablets and phones the sidebar slides in from the menu button.
* **Command palette** – press `Ctrl K` (or `/`) anywhere to jump to a page, run an action or search bookings and inquiries.
* Toast notifications, loading states on buttons, a top progress bar, confirmation dialogs, skeleton loaders on charts and responsive tables that turn into cards on mobile.
* Fonts (Inter, Plus Jakarta Sans), Bootstrap 5.3, Bootstrap Icons and Chart.js are bundled in `public/admin-assets`, so nothing loads from a CDN.

## 4. Notes

* **Emails** use the existing SMTP settings in `.env`. New booking / inquiry notifications go to the address set in *Website Content → General & Contact* (default `info@mirissabaybluewhalesnorkelingtour.com`). If sending fails, the booking/inquiry is still saved and the admin sees a warning.
* **Uploads** are saved to `public/uploads/…`. Original theme images in `public/img` are never deleted by the panel.
* Admin CSS/JS (Bootstrap 5.3, Bootstrap Icons, Chart.js) are bundled in `public/admin-assets`, so the panel works without a CDN.
* Editable content defaults are defined in `config/site_content.php`. To make another text editable, add a field there and use `{{ setting('your.key') }}` in the Blade view.
* Small fixes made while wiring the site: the blue-whale banner linked to a non-existent `whale-snorkeling-page.html` (now `view_blue_whale_snorkeling`), the header map button used a YouTube icon, and the contact email link in the contact section was empty.
