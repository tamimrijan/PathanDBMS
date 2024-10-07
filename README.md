# Pathao (পাঠান) - Courier Management Service

## Project Overview

This project, **Pathao (পাঠান)**, is developed as part of the **CSE311 Database Management Systems (DBMS)** course. It is a comprehensive courier management service that streamlines parcel tracking, delivery, and logistics operations. 

### Features:
- **Parcel Management**: Create, update, and track parcels.
- **User Management**: Manage customer and courier personnel details.
- **Delivery Status**: Track the real-time status of deliveries.
- **Branch Management**: Handle multiple courier branches and their parcel operations.

## Technologies Used

- **Database**: MySQL / PostgreSQL
- **Backend**: PHP / Node.js / Python (Specify your chosen tech)
- **Frontend**: HTML5, CSS3, JavaScript
- **Tools**: 
  - ER Diagram and Database Design using **MySQL Workbench** / **dbdiagram.io**
  - Version Control: **Git**
  
## Database Structure

The database for the Pathao courier management system consists of the following key tables:
1. **Users** (Customers, Couriers)
2. **Parcels**
3. **Branches**
4. **Delivery Statuses**
5. **Transactions**

Each table is designed with appropriate relationships (e.g., one-to-many, many-to-many) to ensure data integrity and optimize performance.

## Installation Instructions

1. Clone this repository:
    ```bash
    git clone https://github.com/yourusername/pathao-courier-management.git
    ```

2. Set up the database:
    - Import the provided SQL schema file to create the necessary tables.
    - Configure the database connection in the backend code.

3. Install dependencies (if applicable):
    ```bash
    npm install
    ```

4. Run the application:
    - For PHP:
      ```bash
      php -S localhost:8000
      ```
    - For Node.js:
      ```bash
      node app.js
      ```

5. Access the application at `http://localhost:8000`.

## Usage

1. **User Registration/Login**: Customers and couriers can register and log in to the system.
2. **Create a Parcel**: Customers can create a new parcel entry by providing necessary details.
3. **Assign Couriers**: Parcels are assigned to couriers based on the location and branch.
4. **Track Parcel**: Both customers and branch employees can track the delivery status of parcels in real-time.

## Screenshots

![App Screenshot](https://i.postimg.cc/Wzjv9pvm/Screenshot-1158.png)

## Future Improvements

- **Payment Integration**: Add payment gateways for online payment processing.
- **Enhanced Reporting**: Create advanced reporting tools for logistics management.
- **Mobile App**: Build a mobile version of the courier management system for wider accessibility.

## Contributors

- **Your Name** - Developer & Database Designer
- (Add other contributors if applicable)

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
