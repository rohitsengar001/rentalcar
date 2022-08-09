# MYSQL SCHEMA 🍧
`Instructions For Creating Database`
## First Method :
  - Download `rental_car.sql` file
  -  Goto PhpMyAdmin 
  - Select new   
  
    ![image](https://user-images.githubusercontent.com/39033056/183602393-edc838f1-1986-4807-ba55-09ce7fef0216.png)
   
  - Goto Import
  ![image](https://user-images.githubusercontent.com/39033056/183602902-6fd0f8ff-9d6a-4f23-a331-2cff9e1cfea2.png)

  - Select Downloaded `rental_car.sql` file
  
  ![image](https://user-images.githubusercontent.com/39033056/183604844-d36d67ec-c936-4977-9408-3018af79353b.png)

## Second Method:
   - `For Creating Database` use this sql command
   ```
    CREATE DATABASE rental_car;
   ```
   - `Creating tables` by using command
  ```
   CREATE TABLE auth_table (
  username varchar(50) NOT NULL,
  password text NOT NULL,
  user_type text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 ``` 
 ```
 CREATE TABLE post_cars (
  username varchar(30) NOT NULL,
  vehicle_model text NOT NULL,
  vehicle_number text NOT NULL,
  seating_capacity text NOT NULL,
  filename text NOT NULL,
  rent_per_day text NOT NULL,
  image_destination text NOT NULL,
  token text NOT NULL,
  vehicle_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 ```
