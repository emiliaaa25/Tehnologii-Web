# IEEE-Tempate
IEEE System Requirements Specification Template

# Software Requirements Specification
## For  <project name>
Version 1.0 approved
Prepared by <author>
<organization>
<date created>
## Table of Contents
1. [Introduction](#1-introduction)
    1. [Scope](#11-scope)
    2. [Document Conventions](#12-document-conventions)
    3. [Intended Audience and Reading Suggestions](#13-intended-audience-and-reading-suggestions)
    4. [Product Scope](#14-product-scope)
    5. [References](#15-references)
2. [Overall Description](#2-overall-description)
    1. [Product Perspective](#21-product-perspective)
    2. [Product Functions](#22-product-functions)
    3. [User Classes and Characteristics](#23-user-classes-and-characteristics)
    4. [Operating Environment](#24-operating-environment)
    5. [Design and Implementation Constraints](#25-design-and-implementation-constraints)
    6. [User Documentation](#26-user-documentation)
    7. [Assumptions and Dependencies](#27-assumptions-and-dependencies)
3. [System Features](#3-system-features)
    1. [Viewing the Latest Awards & Nominees in the Film Industry](#89-viewing-the-latest-awards--nominees-in-the-film-industry)
    2. [Searching & Viewing an actor's page & info](#91searching-&-viewing-an-actors-page-&-info)
    3. [Viewing Awards and Winners for a Specific Year](#116-viewing-awards-and-winners-for-a-specific-year)




## Revision History
| Name | Date    | Reason For Changes  | Version   |
| ---- | ------- | ------------------- | --------- |
|      |         |                     |           |
|      |         |                     |           |
|      |         |                     |           |

## 1. Introduction
### 1.1 Scope 
The platform aims to provide users with access to a rich collection of information regarding nominations and awards given to actors and films from various years. The fundamental goal is to create a centralized and easily accessible resource for users, enabling them to explore and analyze the evolution and performance of actors and films.

### 1.2 Document Conventions
Describe any standards or typographical conventions that were followed when writing this SRS, such as fonts or highlighting that have special significance. For example, state whether priorities  for higher-level requirements are assumed to be inherited by detailed requirements, or whether every requirement statement is to have its own priority.
### 1.3 Intended Audience and Reading Suggestions
Describe the different types of reader that the document is intended for, such as developers, project managers, marketing staff, users, testers, and documentation writers. Describe what the rest of this SRS contains and how it is organized. Suggest a sequence for reading the document, beginning with the overview sections and proceeding through the sections that are most pertinent to each reader type.
### 1.4 Product Scope
Provide a short description of the software being specified and its purpose, including relevant benefits, objectives, and goals. Relate the software to corporate goals or business strategies. If a separate vision and scope document is available, refer to it rather than duplicating its contents here.
### 1.5 References
List any other documents or Web addresses to which this SRS refers. These may include user interface style guides, contracts, standards, system requirements specifications, use case documents, or a vision and scope document. Provide enough information so that the reader could access a copy of each reference, including title, author, version number, date, and source or location.

## Overall Description
### 2.1 Product Perspective

The software described in this document comprises a set of interconnected web pages designed to create a cohersie user experience for a multimedia entertainment platform. These web pages include:
The software described in this document comprises a set of interconnected web pages designed to create a cohesive user experience for a multimedia entertainment platform. These web pages include:

- HomePage: The main landing page of the platform.
- Actors: A page that displays information about actors.
- Years: A page that categorizes content by years.
- Year: A page that provides details about a specific year.
- Actor: A page that provides details about a specific actor.
### 2.2 Product Functions
The users can:
- Search for actors and movies
- View information about actors and movies
- Filter content by year and name
- Access a multitude of actors

### 2.3 User Classes and Characteristics
At the moment, the users of the system are regular users who don't need an account. They have access to all mentioned functionalities.
### 2.4 Operating Environment
The application is designed to run on both PC and mobile devices. It requires an internet connection to access the web pages and retrieve data. The supported operating systems include Windows, macOS, iOS, and Android. The application is compatible with popular web browsers such as Chrome, Firefox, Safari, and Edge. It is recommended to have the latest version of the web browser installed for optimal performance and compatibility.

## System Features
### 3.1 Viewing the Latest Awards & Nominees in the Film Industry
3.1.1 Description and Priority
This feature allows users to view the latest awards and nominees in the film industry. It is of high priority as it provides up-to-date information to users.

3.1.2 Stimulus/Response Sequences
- The system retrieves the latest awards and nominees data from the database.
- The system displays the awards and nominees information on the user interface.

3.1.3 Functional Requirements
- The system should have a database that stores the latest awards and nominees data.
- The system should provide a user interface that allows users to access the "Latest Awards & Nominees" feature.
- The system should retrieve the latest awards and nominees data from the database.
- The system should display the awards and nominees information in a clear and organized manner.

### 3.2 Searching & Viewing an actor's page & info
3.2.1 Description and Priority
This feature allows users to search for and view an actor's page and information.
ActorInfo: A page that provides detailed information about a specific actor, including their biography, filmography, awards, and other relevant details.

3.2.2 Stimulus/Response Sequences
- The user enters the name of the actor in the search bar.
- The system retrieves the actor's information from the database.
- The system displays the actor's page and information on the user interface.

3.2.3 Functional Requirements
- The system should have a database that stores information about actors.
- The system should provide a search bar for users to enter the name of the actor.
- The system should retrieve the actor's information from the database based on the search query.
- The system should display the actor's page and information, including their biography, filmography, and other relevant details.

3.2.4 Performance Requirements
- The search functionality should provide fast and accurate results, even with a large number of actors in the database.
- The actor's page and information should load quickly and be responsive to user interactions.
- The actor's page and information should be presented in a visually appealing and user-friendly manner.

3.2.5 Security Requirements
As there are no users and the database management is handled by the admin, there are no specific security requirements for this feature. The accuracy and correctness of the data on actors in the database is the responsibility of the admin.

3.2.6 Constraints
- The system should be able to handle a wide range of actor names, including special characters and non-English characters.
- The actor's information should be kept up-to-date and synchronized with any changes or updates in the database.
### 3.3 Viewing Awards and Winners for a Specific Year
4.3.1 Description and Priority
This feature allows users to view the awards and winners for a specific year.

3.3.2 Stimulus/Response Sequences
- The user selects a specific year from a dropdown menu or enters the year in a search bar.
- The system retrieves the awards and winners data for the selected year from the database.
- The system displays the awards and winners information on the user interface.

3.3.3 Functional Requirements
- The system should have a database that stores the awards and winners data for each year.
- The system should provide a dropdown menu or search bar for users to select or enter a specific year.
- The system should retrieve the awards and winners data for the selected year from the database.
- The system should display the awards and winners information, including the movies and actors that won awards in the selected year.

3.3.4 Performance Requirements
- The retrieval of awards and winners data for a specific year should be fast and efficient, even with a large amount of data in the database.
- The display of awards and winners information should be responsive and provide a smooth user experience.

3.3.5 Constraints
- The system should be able to handle a wide range of years.
- The awards and winners data should be kept up-to-date and synchronized with any changes or updates in the database.
