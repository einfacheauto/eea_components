#  EEA Components

Welcome to our project! This project is built on the TYPO3 version 12 and follows best practices for development and collaboration.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Getting Started](#getting-started)
3. [Development Guidelines](#development-guidelines)
4. [Testing](#testing)
5. [Conventional Commits](#conventional-commits) 
6. [Contributing](#contributing)
7. [License](#license)

## Project Overview

This TYPO3 project aims to [brief project description, e.g., "deliver a high-performance, scalable website for our client."] It includes custom extensions, integrations with third-party services, and follows TYPO3 coding standards.

## Getting Started

### Prerequisites

- Typo3 v.12.4.x
- PHP v.8.1.29
- Composer v.X.X.X
- MySQL or MariaDB (Client API header version: 10.6.18-MariaDB)

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Bais92/eea_components.git
    ```
2. Navigate into the project directory:
    ```bash
    cd your-repo
    ```
3. Install dependencies:
    ```bash
    composer install
    ```
4. Set up the database and configure your `.env` file accordingly.

5. Run the TYPO3 setup wizard by accessing `/typo3/install.php` in your browser.

## Development Guidelines

- Follow the TYPO3 coding standards.
- Ensure that all custom extensions are placed in `typo3conf/ext/`.
- All configurations should be managed via site packages and TypoScript.

## Testing

### Running Tests

- Unit tests are written using PHPUnit and are located in the `Tests/` directory of each extension.
- Run tests using the following command:
    ```bash
    composer test
    ```
- Ensure all tests pass before committing any code.

### Test Coverage

- Aim for high code coverage for all critical functionalities.
- Generate test coverage reports with:
    ```bash
    composer coverage
    ```

## Conventional Commits

This project uses [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) for commit messages. This is essential to ensure consistent commit history and helps in automating the release process.

### Commit Message Format

Each commit message should have the following format:

<type>(<scope>): <subject>


#### Types:
- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation only changes
- `style`: Changes that do not affect the meaning of the code (white-space, formatting, etc.)
- `refactor`: A code change that neither fixes a bug nor adds a feature
- `test`: Adding missing tests or correcting existing tests
- `chore`: Changes to the build process or auxiliary tools and libraries such as documentation generation

### Examples:

- `feat(homepage): add carousel for featured content`
- `fix(contact-form): correct email validation`


## License

This project is proprietary and not licensed for public distribution. All rights are reserved by the project owner. Unauthorized copying, modification, or distribution of this project’s code and resources is strictly prohibited.
