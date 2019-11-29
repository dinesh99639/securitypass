# SecurityPass

  This project is to make our password more secure and make it difficult to hack .This method uses random generation of numbers for
buttons to enter the password. In this the IP address of the user is also recorded so it makes the hacker to hack it using brute force method. In this project we have given only 5 attempts and if we fail in all of the 5 attempts then the login will be locked for 24 hours. This is the suitable method for securing our passwords.

## Features
1. The IP address gets noted whenever we login.
2. Options given for the entry of password, changes every time we
refresh the page. New options appear randomly whenever we
refresh the page or enter a wrong password. Hence the password
we enter also changes every time.
3. The account gets blocked for 24 hours if we enter a wrong
password continuously for 5 times.
4. This prevents the threat of brute force attack as the account
would get blocked if a wrong password is entered for 5 times in a
row.
5. If the user enters the dashboard without logging in, the user
would be asked to login first to continue.

## Getting Started

Below link is the implemented version of the entire project.
http://securitypass.epizy.com/

### Prerequisites

Your system must be installed with xampp/wampp server running with Apache and MySQL servers.

```
Give examples
```

### Installing

If you want to deploy this project in you machine, import the securitypass.sql file into mysql. Change the database name in database.php.
Otherwise, you can test the implemented model( http://securitypass.epizy.com/ ).

## Running the tests



## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
