import del from 'del';
import gulp from 'gulp';
import zip from 'gulp-zip';

gulp.task('clean', async () => await del(['languages', 'bundled']));

export const bundle = () =>
  gulp
    .src([
      '**/*',
      '!bundled/**',
      '!node_modules/**',
      '!src/**',
      '!.eslintrc.js',
      '!.gitignore',
      '!gulpfile.mjs',
      '!package.json',
      '!package-lock.json',
      '!readme.md',
      '!todo.txt',
      '!webpack.config.js',
    ])
    .pipe(zip('store-finder.zip'))
    .pipe(gulp.dest('bundled'));
