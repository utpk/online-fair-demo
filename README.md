# online-fair-demo
Demo repository for hands-on

# Instructions

### Create our first container application
1. Access your console and check your permission
2. Create New Application (+Add) From Catalog 
   - Select PHP builder image
   - Input this github HTTPS URL `https://github.com/utpk/online-fair-demo.git`
   - Click Advanced Options on **Routing**
     * Under Security section, check **Secure Route**
        - TLS Termination: **Edge**
        - Insecure Traffic: **None**
   - Click Create Application

### Inspect how source-to-image deployment strategy works
1. Under Topology page, click on your new application's circle
2. Under Builds, you will see running build, click **View Logs** to see what is happenning
3. Once build is completed, go back to Topology page and access your application from **open URL** shortcut (top-right corner of your application's circle)

### Updating application configuration in environment variable
1. Under Topology page, click on your new application's circle
2. Click on deployment name at the top of the section (with **'D'** tag)
3. Under Deployment, click on **Environment** tab
4. Try to override configuration value per example below;
   | Single values (env) Name | Value                  |
   | ------------------------ | ---------------------- |
   | APP_TITLE                | {{your name}} Fair     |
   | Q1_TITLE                 | Hello World            |
   | Q1_ICON                  | /quiz_icons/icon12.png |
   
   see [full configuration variable list](https://github.com/utpk/online-fair-demo/blob/main/.s2i/environment)
