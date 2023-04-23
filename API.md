## Endpoint
POST /api/v1/auth/register
Registers a new user.

-**Request Parameters:**
name (required) - The name of the user.
email (required) - The email address of the user.
password (required) - The password of the user.
password_confirmation (required) - The confirmation of the password.

-**Response:**
200 OK - User registered successfully.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while processing the request.

-**Response Body:**
The response body contains the details of the authenticated user in JSON format.
{
    "status": true,
    "message": "User Created Successfully",
    "token": 25|Do3Abo0bxd3yVIksJobPSidqfjO38mmEkDMFVHvC"
}

-**Error Codes**
500 Internal Server Error - An error occurred while processing the request.


## Endpoint
POST /api/v1/auth/login
Logs in a user.

-**Request Parameters:**
email (required) - The email of the user.
password (required) - The password of the user.

-**Response Body:**
The response body contains the details of the authenticated user in JSON format.

{
    "status": true,
    "message": "User Logged In Successfully",
    "token": "1|YSGDWTbs9AgczQ1IpBfnWzSUXfnkL0eLeJUXLQaE"
}

-**Response:**
200 OK - User logged in successfully.
401 Unauthorized - Authentication failed.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while processing the request.

-**Error Codes**
401 Unauthorized - Authentication failed.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while processing the request.


## Endpoint
POST /api/v1/updatepassword/{user_id}
Updates a user's password.

-**Request Headers:**
Authorization - Bearer token

-**Request Parameters:**
user_id (required) - The ID of the user whose password will be updated.
currentPassword (required) - The user's current password.
newPassword (required) - The user's new password.
newPassword_confirmation (required) - The confirmation of the new password.

-**Response Body:**
The response body contains the details of the authenticated user in JSON format.
{
    "status": true,
    "message": "Password updated successfully"
}

-**Response:**
200 OK - Password updated successfully.
401 Unauthorized - Authentication failed.
403 Forbidden - The authenticated user is not authorized to update the user's password.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while updating the password.


-**Error Codes**
This API returns the following error codes:
401 Unauthorized - Authentication failed.
403 Forbidden - The authenticated user is not authorized to perform the requested action.
404 Not Found - The requested resource was not found.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while processing the request.


## Endpoint
POST /api/v1/profile/{id}
Updates a user's profile.

-**Request Headers:**
Authorization - Bearer token

-**Request Parameters:**
id (required) - The ID of the user whose profile will be updated.
name (optional) - The user's new name.
email (optional) - The user's new email address.

-**Response Body:**
The response body contains the details of the authenticated user in JSON format.
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com",
        "email_verified_at": null,
        "created_at": "2023-04-22T08:30:17.000000Z",
        "updated_at": "2023-04-23T13:21:35.000000Z"
    }
}

-**Response:**
200 OK - Profile updated successfully.
401 Unauthorized - Authentication failed.
403 Forbidden - The authenticated user is not authorized to update the user's profile.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while updating the profile.

-**Error Codes**
This API returns the following error codes:

401 Unauthorized - Authentication failed.
403 Forbidden - The authenticated user is not authorized to perform the requested action.
404 Not Found - The requested resource was not found.
422 Unprocessable Entity - The request parameters are invalid.
500 Internal Server Error - An error occurred while processing the request.


## Endpoint
GET /api/v1/user
Returns details of the authenticated user.

-**Request Headers:**
Authorization - Bearer token

-**Response:**
200 OK - The request was successful. The response body contains the details of the authenticated user.
401 Unauthorized - Authentication failed.
500 Internal Server Error - An error occurred while processing the request.

-**Response Body:**
The response body contains the details of the authenticated user in JSON format.

{
    "id": 123,
    "name": "John Doe",
    "email": "johndoe@example.com",
    "created_at": "2021-01-01T00:00:00.000000Z"
}

-**Error Codes**
This API returns the following error codes:

401 Unauthorized - Authentication failed.
500 Internal Server Error - An error occurred while processing the request.

## Note: 
The updatepassword endpoint requires authentication, so the user must be logged in before accessing it.
on successfull login the response will contain a bearer token that is supposed to be passed with each request
Find Attached Postman collection in the root of the folder [persona.postman_collection]




