Codices
=======

This is a small WEB based platform for managing personal book collections and libraries. It is meant to be used only 
for small, personal, libraries and does not provide any of the standard features of a full library management platform.

With Codices you'll be able to manage your books, their collections and series they're part of. Though not specifically 
made for eBooks, you may be able to use it to manage your eBook collection.

Codices also features a companion APP (still in development), for both Android and iOS that offers access to the 
existing API.

**NOTICE:** This project, along with the [Books Android APP](https://github.com/Knitter/amsi-books), is being used as 
part of the course *Acesso Móvel a Sistemas de Informação*, therefore it will have some features needed in the course 
and the APP.

# Platform Structure

```
Root Folder
├── codices
│   ├── app         # main Codices application, offers backend/web access
│   ├── commom      # source file shared by all other applications
│   ├── console     # application for console/maintenance usage
│   ├── migrations  # contains all database migrations
│   └── rest        # application that provides the REST API
│
├── public          # root of the public webserver's folder
│   ├── app         # contains the entry script and public resources for the main Codices application
│   └── rest        # contains the entry script for the REST API
│
├── sql             # SQL version of the migration files, it can be used to install/upgrade where 
│                     composer is unavailable
│
└── vendor          # required system libraries, managed by composer
```

## Codices application

**Codices** is the name of the platform comprised of a backend/web application that allows managing books and their 
general metadata, a REST API that allows access to the platform's features through a JSON based interface and a pair 
of mobile applications that consume the API.

The main application, and the focus for most users, will be the WEB backend. If you want, you can use the WEB version 
and ignore the REST API.

## REST API

The REST API is also part of the Codices platform and will always be present, though it may not be used. At some future 
version I may add an option to disable or hide the API. For now, if you wish to disable it, you need to remove de 
**index.php** file in the **public/rest** directory.

# Credits

To create the layout and general look I started with a modified version of the Bootflat-Admin template, that is also 
based in Bootflat. These projects where the base of the admin/backend user interface and can be found 
at [https://github.com/silverbux/bootflat-admin](https://github.com/silverbux/bootflat-admin)
and [http://bootflat.github.io](http://bootflat.github.io).

# License

Codices is licensed under the AGPL Open Source license. Please check the 
[LICENSE.txt](https://raw.githubusercontent.com/Knitter/codices/master/LICENSE.txt) file for more information.
