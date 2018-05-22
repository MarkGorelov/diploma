<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 22.05.2018
 * Time: 12:35
 */

class ResumeController
{
    public function actionIndex()
    {
        $latestResumes = array();
        $latestResumes = Resume::getLatestResume();

        $tagsResume = array();
        $tagsResume = Tag::getTagListByResume();

        $categories = array();
        $categories = Category::getCategoryList();

        require_once(ROOT . '/views/resume/index.php');
        return true;
    }

    public function actionView($resumeId)
    {
        $resume = Resume::getResumeById($resumeId);

        $tagsResume = array();
        $tagsResume = Tag::getTagListByResume();

        $workExperienceResume = array();
        $workExperienceResume = WorkExperience::getWorkExperienceListByResume();

        $educationResume = array();
        $educationResume = Education::getEducationListByResume();

        require_once(ROOT . '/views/resume/view.php');
        return true;
    }
}