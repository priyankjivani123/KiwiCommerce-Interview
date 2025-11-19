	# Magento 2 Testimonials Extension

This is a custom **Magento 2 Testimonials extension** that allows you to manage testimonials from the admin panel, API, and import CSV files via command line.

---

## Features

* Add, edit, and delete testimonials from Magento admin.
* Access testimonials via REST API.
* Import testimonials in bulk via CSV using a CLI command.
* Displayed testimonial block in home page before footer
* Translation for all labels and texts with i18n
* Used Standard Magento code
---

## API Endpoints

### Get All Active Testimonials

```http
GET /rest/V1/testimonials?searchCriteria[filter_groups][0][filters][0][field]=status&searchCriteria[filter_groups][0][filters][0][value]=1
```

### Get Testimonial by ID

```http
GET /rest/V1/testimonials/{id}
```

### Create Testimonial

```bash
curl -X POST "http://127.0.0.1/php83/magento248-p3/pub/rest/V1/testimonials" \
-H "Content-Type: application/json" \
-d '{
  "testimonials": {
    "company_name": "PriyankTech",
    "name": "Priyank Jivani",
    "message": "This is a testimonial via API",
    "post": "CEO",
    "profile_pic": "priyank.jpg",
    "status": 1
  }
}'
```

### Delete Testimonial

```bash
curl -X DELETE "http://127.0.0.1/php83/magento248-p3/pub/rest/V1/testimonials/{id}" \
-H "Content-Type: application/json"
```

---

## CLI Command

You can import testimonials from a CSV file using the following Magento CLI command:

```bash
php bin/magento testimonials:import /path/to/your/testimonials.csv
```

Example:

```bash
php bin/magento testimonials:import /home/vdc/projects/php83/magento248-p3/app/code/Priyank/Testimonials/ImportCSVFile/testimonials_2025-11-19_10-10-55.csv
```

---

## Installation

1. Copy the `Priyank/Testimonials` folder to `app/code/` in your Magento installation.
2. Enable the module:

```bash
php bin/magento module:enable Priyank_Testimonials
php bin/magento setup:upgrade
php bin/magento cache:flush
```

3. (Optional) Deploy static content if needed:

```bash
php bin/magento setup:static-content:deploy
```

---

## Notes

* Make sure the API URLs match your Magento base URL.
* Ensure proper file permissions for CSV import.
* Profile pictures should be uploaded to the media folder before importing.

---

## Author

**Priyank Jivani**
Email: [[priyankjivani48@gmail.com](mailto:priyankjivani48@gmail.com)]
GitHub: [https://github.com/priyankjivani123](https://github.com/priyankjivani123)

---

This README provides complete instructions for installation, API usage, and data import.
