# specbee-assingment
Custom module to provide a custom configuration and create custom block on the basis of configuration.

**Story**: As a user, I should be able to see the Site location and the current time for the location in the below format: 
**12:32 pm**
Monday, 11 September 2023
Time in New York, NY, USA

Implementation details:
Add an ADMIN CONFIGURATION form which will take the following inputs:
Country - text field
City - text field
Timezone - select list
Options in the select list
America/Chicago
America/New_York
Asia/Tokyo
Asia/Dubai
Asia/Kolkata
Europe/Amsterdam
Europe/Oslo
Europe/London
Create a service that will return the current time based on the time zone selection in the above form. Time should be in the format 19th Sept 2022 - 11:15 AM
Add a Block plugin that will render the Location from the configuration set in the configuration form and the current time calling the service in the previous step. 
Pass the variables to a template to be rendered.
Acceptance Criteria
Ensure that default configurations are provided by the module.
Since this block will be placed on all the pages, caching needs to be enabled on the block. 
However, the time must be updated without a cache rebuild.
Any service calls should be done using Dependency Injection. Any direct calls to services are not allowed.
Ensure your code must follow Drupal coding standards and DrupalPractice code standards using PHP CodeSniffer. 
Once done, please share the Github URL of the module.  If you don't have a GitHub profile please create one. Any kind of Zip files will not be entertained
The GitHub repository MUST have at least 3 commits from your username with proper commit messages.


**Post installation instruction:**
After installion of module Go to Block Layout page and place the block **DateTimeLocationBlock** in any region of active theme.
After that go to module configuration link from module details and there you can update the Country, City and Timezone and check changes on block.

