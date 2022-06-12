Codices
=======

This is a small WEB based platform for managing personal book collections and libraries. It is meant to be used only
for small, personal, libraries and does not provide any of the standard features of a full library management platform.

With Codices you'll be able to manage your books, and e-books, their collections and series they're part of.

Codices also features a companion APP (still in development, not yet available), for both Android and iOS, that offers
access to the existing API.

> **NOTICE:** I use this project to test programming languages, libraries, frameworks, etc., and have used it often in
> the various courses I've taught.
>
> The ```main``` branch is stable and meant to contain the current version of Codices. Other branches contain unstable,
> experimental and temporary code. If you wish to use Codices, use only a release file or the code from ```main```
> branch.

# Features

* Manage books
* Manage e-books
* Export library as JSON or single HTML page
* Integration API

# Platform Structure

```
Root Folder
├── build         Development related files and output
│   ├── runtime   Contains cache files, temporary files used by several dev tools (eg. unit testing output)
│   └── server    Vagrant related files and server settings; these files are used only during development
|
├── codices       Main application files
│   ├── ...
│   ├── modules   Contains REST API module code
│   ├── runtime   Will be used for database and view cache, error logging and other runtime files needed by Yii2
│   └── ...
|
├── common        Common code, shared by codices and console applications
├── config        All application configuration files, organized by application name
│   ├── codices   
│   ├── common    
│   └── console   
|
├── console       Console application, used during development, deployment and maintenance
├── docs
├── public        Public files, should be the root of you're domain/sub-domain
├── tests
└── vendor        Required libraries, managed by composer
```

## Codices application

**Codices** is the name of the platform comprised of a backend/web application that allows managing books and their
general metadata, a REST API that allows access to the platform's features through a JSON based interface and a pair
of mobile applications that consume the API.

The main application, and the focus for most users, will be the WEB backend. If you want, you can use the WEB version
and ignore the REST API.

## REST API

The REST API is also part of the Codices platform and will always be present, though it may not be used. At some future
version I may add an option to disable or hide the API. It is disabled by default, but can be enabled by uncommenting
the config entry in the ```config\codices\web.php``` file.

# Credits

The layout and general look are provided by the [Tabler](https://github.com/tabler/tabler) Dashboard UI Kit, created
by [Paweł Kuna](https://github.com/sponsors/codecalm).

# License

Codices is licensed under the AGPL Open Source license. Please check the
[LICENSE.txt](https://raw.githubusercontent.com/Knitter/codices/master/LICENSE.txt) file for more information.
