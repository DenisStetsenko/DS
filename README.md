# WordPress Theme
##

### Dev Process:
1. run `bower install -p` (for dependencies)
2. run `gulp copyAssets` (to copy libraries to `dist` folder)
3. run `gulp delAssets` (to delete libraries from `lib` folder)
4. run `gulp sass`  (to compile SASS)
5. run `gulp bootstrapJS` (to copy and combine bootstrap js libraries to `scripts` folder)
6. run `gulp watch:dev` (to watch for changes -> task `gulp sass:dev`)

### Production Process:
1. Change `environments.current(development)` to `environments.current(production)`
2. run `gulp sass` (to compile SASS with autoprefixer and without sourcemaps)
2. run `gulp combineJS` (to combine JS files into one, called `scripts.min.js`)
4. run `gulp watch:prod` (to watch for changes -> task `gulp sass`)

### Notes:
1. Based on [Bootstrap 5](https://getbootstrap.com/)
2. Includes `gulpfile.js`, based on [Gulp 4](https://github.com/gulpjs/gulp/blob/4.0/CHANGELOG.md)
3. Has pre-installed plugins under **Plugins -> Required Plugins**
4. Has local **ACF** fields under **Custom Fields -> Sync Available** 
4. Has local **ACF** field type **Button** 


### Package.json:
```json
{
  "name": "wp-theme",
  "version": "1.0.0",
  "description": "WordPress Starter Theme with SASS & Gulp 4.0",
  "license": "UNLICENSED",
  "browserslist": [
    "Chrome >=45",
    "Firefox >=45",
    "Edge >= 12",
    "Safari >= 9",
    "ie >= 10",
    "iOS >=8",
    "> 1.0%"
  ],
  "devDependencies": {
    "browser-sync": "^2.27.5",
    "check-files-exist": "^1.0.1",
    "del": "^2.2.2",
    "gulp": "4.0.2",
    "gulp-add-src": "^1.0.0",
    "gulp-autoprefixer": "^8.0.0",
    "gulp-batch": "^1.0.5",
    "gulp-cached": "^1.1.1",
    "gulp-changed": "^1.3.2",
    "gulp-clone": "^1.1.4",
    "gulp-concat": "^2.6.0",
    "gulp-cssnano": "^2.1.3",
    "gulp-debug": "^2.1.2",
    "gulp-env": "^0.4.0",
    "gulp-environments": "^1.0.1",
    "gulp-footer": "2.0.1",
    "gulp-hg": "^1.0.5",
    "gulp-ignore": "^2.0.1",
    "gulp-liquid": "^0.1.0",
    "gulp-liquify": "^0.0.6",
    "gulp-merge": "^0.1.1",
    "gulp-newer": "^1.4.0",
    "gulp-notify": "^4.0.0",
    "gulp-order": "^1.2.0",
    "gulp-plumber": "^1.2.1",
    "gulp-remember": "^0.3.1",
    "gulp-rename": "^2.0.0",
    "gulp-rimraf": "^0.2.2",
    "gulp-sourcemaps": "^3.0.0",
    "gulp-uglify": "^2.0.0",
    "gulp-util": "^3.0.8",
    "gulp-watch": "^5.0.1"
  },
  "dependencies": {
    "gulp-sass": "^5.1.0",
    "node-sass": "^7.0.1",
    "sass": "^1.49.9"
  }
}
```