<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


//Main Page routes
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/help', 'PagesController@help');

//Authentication routes
Auth::routes();

//Routes for configurations
Route::get('/config', 'ConfigurationsController@config');
//user registration
Route::post('/config', 'ConfigurationsController@register');


//Dashboard route-DashboardController instead of name HomeController
Route::get('/dashboard', 'DashboardController@index');

//Routes for contact messages
Route::resource('contact','ContactsController');

//Routes for Academic Years model
Route::resource('academic_years', 'AcademicYearsController');

//Routes for Course model
Route::resource('courses', 'CoursesController');

//Routes for Department model
Route::resource('departments', 'DepartmentsController');

//Routes for Grades model
Route::resource('grades', 'GradesController');
//Route for handle search results
Route::post('/grades/search','GradesController@search');
//Route for getting subjects
Route::post('/grades/subjects','GradesController@findSubjects');
//Route for show students to add results
Route::post('/grades/showStudents','GradesController@showStudentsToStore');
//Route for import grades from excel
Route::post('/grades/importGrades','GradesController@importGrades');
//Rourte for edit results
Route::post('/grades/showResults','GradesController@showStudentsToEdit');
//Route for update results
Route::post('/grades/updateResults','GradesController@updateGrades');
//Route for publish results
Route::post('/grades/publishResults','GradesController@publishResults');
// Route for GPA page 
Route::get('/gpa','GradesController@showGPApage');
//Rote for add repeat subject results
Route::post('/grades/addRepeatSubjectResults','GradesController@addRepeatSubjectResults');



//Routes for Grsding model
Route::resource('gradings', 'GradingsController');

//Routes for lecture model
Route::resource('lectures', 'LecturesController');

//Routes for Lecture_Subjects model (settings)
Route::resource('lecture_subjects', 'Lecture_SubjectsController');

//Routes for Specialized Areas model
Route::resource('specialized_areas', 'SpecializedAreaController');

//Routes for Studenst model
Route::resource('students', 'StudentsController');

//Routes for Student_Subjects model (NOT USED replaced by SettingsController)
Route::resource('student_subjects', 'Student_SubjectsController');

//Routes for Subjects model
Route::resource('subjects', 'SubjectsController');

//Route for profiles
Route::get('/profile', 'ProfilesController@showProfile');
//Change password route
Route::post('/ChangePassword','ProfilesController@changePassword')->name('changePassword');
//Change personal details route
Route::put('/PersonalDetails/{user}','ProfilesController@updatePersonalDetails');

//Settings route
Route::get('/settings','SettingsController@showSettingsPage');
//Show students page route
Route::post('/settings/students','SettingsController@showStudentsSettingsPage');
//Specializations page route
Route::post('/settings/students/{student_registration_number}','SettingsController@showSpecializationsSettingsPage');
//Config route
Route::post('/settings/students/{student_registration_number}/config','SettingsController@config');

//Route for edit student-profile page
Route::get('/profile/student/edit', 'ProfilesController@editStudentProfile');
Route::post('/profile/student/edit/{user_name}', 'ProfilesController@updateStudentProfile');

//Route for edit Lecture-profile page
Route::get('/profile/lecture/edit', 'ProfilesController@editLectureProfile');
Route::post('/profile/lecture/edit/{user_name}', 'ProfilesController@updateLectureProfile');

//Route for index page of Reports
Route::get('/reports','ReportsController@index');
//Students
//Route for studentsInSpecificAcademicYear
Route::post('/reports/student_details/studentsInSpecificAcademicYear','ReportsController@studentsInSpecificAcademicYear');
//Route for studentsInSpecificCourse
Route::post('/reports/student_details/studentsInSpecificCourse','ReportsController@studentsInSpecificCourse');
//Route for studentsInSpecificDepartment
Route::post('/reports/student_details/studentsInSpecificDepartment','ReportsController@studentsInSpecificDepartment');
//Route for studentsInSpecificSpecializedArea
Route::post('/reports/student_details/studentsInSpecificSpecializedArea','ReportsController@studentsInSpecificSpecializedArea');
//Route for fullDetailsOfStudent
Route::post('/reports/student_details/fullDetailsOfStudent','ReportsController@fullDetailsOfStudent');
//Route for assignedSubjectsOfStudent
Route::post('/reports/student_details/assignedSubjectsOfStudent','ReportsController@assignedSubjectsOfStudent');
//Lecture
//Route for allLecturesInFaculty
Route::post('/reports/lecture_details/allLecturesInFaculty','ReportsController@allLecturesInFaculty');
//Route for lecturesInSpecificDepartment
Route::post('/reports/lecture_details/lecturesInSpecificDepartment','ReportsController@lecturesInSpecificDepartment');
//Route for assignedSubjectsOfSpecificLecture
Route::post('/reports/lecture_details/assignedSubjectsOfSpecificLecture','ReportsController@assignedSubjectsOfSpecificLecture');
//Route for fullResultsOfSpecificStudent
//Grades/Results
Route::post('/reports/grades/fullResultsOfSpecificStudent','ReportsController@fullResultsOfSpecificStudent');
//Route for subjectResults
Route::post('/reports/grades/subjectResults','ReportsController@subjectResults');
//Route for semesterResults
Route::post('/reports/grades/semesterResults','ReportsController@semesterResults');
//Course
//Route for courseDetails
Route::post('/reports/courses/courseDetails','ReportsController@courseDetails');
//Gradings
//Route for gradingSystem
Route::post('/reports/courses/gradingSystem','ReportsController@gradingSystem');


//Notifications
//Route for mark all as read
Route::get('/notifications/all','NotificationsController@markAsReadAll')->name('markAllAsRead');
//Route for mark as read
// Route::post('/notifications','NotificationsController@markAsRead');