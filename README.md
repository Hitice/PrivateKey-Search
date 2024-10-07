# PrivateKey Search

**PrivateKey Search** is a Laravel-based web scraper designed to crawl web pages and extract specific data based on user-defined regular expressions. 
The tool is built with scalability in mind, allowing you to extend its capabilities easily and customize it for various data scraping tasks. 
This project uses the **Goutte** web scraping library and is optimized for crawling discussion topics, such as those found on forums like **Bitcointalk**.

## Features

- **Regex-based data extraction**: The crawler uses customizable regular expressions to identify and extract data, such as specific patterns or text formats (e.g., Bitcoin private key formats).
- **Web page crawling**: It automatically crawls pages, follows links, and scrapes content across multiple pages, respecting website rate limits to avoid overload or bans.
- **Customizable starting point**: The starting URL and regex pattern for data scraping can be passed as arguments when running the command.
- **Pagination handling**: The crawler identifies and follows pagination links to scrape data from multi-page discussions.
- **Time Range Filtering**: Optionally scrape discussions or data within a specified date range (e.g., only discussions from 2010 to 2012).
- **Duplicate checking**: Prevents duplicate data from being stored in the database by checking for existing records before saving.

## How It Works

1. The user specifies the starting URL and regex pattern as arguments when running the command. If no arguments are provided, the script defaults to scraping the **Bitcointalk** forum with a regex pattern targeting Bitcoin private key formats.
2. The script requests the page, extracts relevant content based on the regex, and stores the results in the database.
3. The crawler follows links to new topics or paginated results to continue scraping.
4. It ensures that rate limits are respected by adding a delay between requests to prevent overloading the target site.

## Requirements

- PHP >= 7.4
- Laravel 8.x or later
- Composer
- Goutte library for web scraping

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/privatekey-search.git
   ```

2. Navigate to the project directory:
   ```bash
   cd privatekey-search
   ```

3. Install dependencies via Composer:
   ```bash
   composer install
   ```

4. Set up your `.env` file and configure your database connection.

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

## Usage

To start the crawler, use the following command:

```bash
php artisan crawler:start {url?} {regex?}
```

- `url?`: (Optional) Starting URL for the crawler. Default: `https://bitcointalk.org/index.php?action=search`.
- `regex?`: (Optional) Regular expression for extracting data. Default: Regex targeting Bitcoin private key formats.

Example:

```bash
php artisan crawler:start "https://bitcointalk.org/index.php?action=search" "/(?:5[HJK][1-9A-Za-z]{49}|[KL][1-9A-HJ-NP-Za-km-z]{51})/"
```

The script will crawl the provided URL, extract data matching the regex, and store the results in the database.

## Customization

### Time Delay Between Requests

To respect rate limits and prevent overloading the target website, the crawler includes a configurable delay between requests. By default, the delay is set to 3 seconds, but you can adjust it in the code by modifying the `$delayBetweenRequests` variable.

### Date Range Filtering

The crawler can also be adjusted to scrape only within a specified date range. For example, you can configure it to focus on topics posted between 2010 and 2012 by customizing the date logic in the crawler.

## Contributing

Feel free to open issues or submit pull requests for improvements or bug fixes. Any contribution is highly appreciated.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

This README provides an overview of what your **PrivateKey Search** project does, how to install and use it, and mentions customization options for users who want to adapt it to their needs.