<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://github.com/Ryldi/ConnectFriend/blob/main/public/images/logo.png" width="400" alt="ConnectFriend Logo">
  </a>
</p>


## About ConnectFriend

**ConnectFriend** is a social networking platform designed to connect users through casual friendships, shared interests, and hobbies. The platform was developed as part of a university project using the following technologies:

- **Framework**: Laravel
- **Frontend**: Bootstrap
- **Database**: MySQL

### Features

1. **User Authentication**  
   - Users can register and log in.  
   - Validation rules for registration include:  
     - Gender selection: Male/Female.  
     - Minimum of 3 hobbies.  
     - Instagram username: Must follow the format `http://www.instagram.com/username`.  
     - Mobile number: Digits only.  
   - Randomized registration fee between 100,000 and 125,000.  

2. **Payment**  
   - Users must complete payment to finalize registration.  
   - Validation for underpayment and overpayment:  
     - Underpayment: Displays a message with the missing amount.  
     - Overpayment: Option to convert excess payment into wallet balance.  

3. **Friends**  
   - Add or remove friends by liking profiles based on mutual interests.  
   - Friends are displayed on the user's profile.  

4. **Messaging**  
   - Users can send messages to their connected friends.  

5. **Search & Filter**  
   - Users can search for others and filter by gender or hobbies/field of work.  

6. **Notifications**  
   - Notifications for friend requests and incoming messages.  

7. **Avatar Purchase**  
   - Users can buy avatars using coins and set them as profile pictures.  

8. **Topup Coins**  
   - Add 100 coins with a single button click.  
   - Enabling invisibility changes the profile photo to a bear and deducts coins.  

9. **Localization**  
   - Supports both Indonesian and English.  
   - Language switch available on any page.  

### Installation

Follow these steps to set up the project locally:

1. Clone the repository:  
   ```bash
   git clone https://github.com/Ryldi/ConnectFriend.git
   cd ConnectFriend
   composer install
   php artisan migrate
   php artisan db:seed
   php artisan serve
