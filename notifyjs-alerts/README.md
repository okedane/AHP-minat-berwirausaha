# Notify.js Alerts

This project demonstrates how to use Notify.js to create and display notification alerts in a web application. It includes a simple setup with HTML, CSS, and JavaScript files to help you get started with implementing notifications in your own projects.

## Project Structure

```
notifyjs-alerts
├── src
│   ├── index.html        # Main HTML document
│   ├── css
│   │   └── styles.css    # Styles for the application
│   └── js
│       ├── main.js       # Main JavaScript file
│       └── notify-init.js # Initialization of Notify.js
├── package.json          # npm configuration file
├── .gitignore            # Files to ignore in Git
└── README.md             # Project documentation
```

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd notifyjs-alerts
   ```

3. Install the dependencies:
   ```
   npm install
   ```

## Usage

1. Open `src/index.html` in your web browser.
2. The application will load and you can trigger notifications using the functions defined in `src/js/main.js`.

## Examples

To create a notification, you can call the function defined in `notify-init.js`. For example:

```javascript
showNotification('This is a notification!', 'info');
```

## Contributing

Feel free to submit issues or pull requests to improve the project. 

## License

This project is open-source and available under the MIT License.