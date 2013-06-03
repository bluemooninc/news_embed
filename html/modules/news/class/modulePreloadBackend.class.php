<?php
if (!defined('XOOPS_ROOT_PATH')) exit();
class bulletinModulePreloadBackend extends XCube_ActionFilter
{
    function preBlockFilter() {
        $delegate=new XCube_Delegate("bulletinModulePreloadBackend", "getRSS");
        $this->mController->mRoot->mEventManager->add("Module.Legacy.Backend.getRSS", $delegate);
    }
    function getRSS(&$sender, &$eventArgs) {
        require_once XOOPS_ROOT_PATH . "/modules/news/class/class.newsstory.php";
        $storyArr = NewsStory::getAllPublished(10, 0);
        $module_handler =& xoops_gethandler('module');
        $module =& $module_handler->getObjects(new Criteria('dirname', 'bulletin'));
        foreach ($storyArr as $story) {
            $eventArg = array (
                'title'       => $story->getVar('title'),
                'link'        => XOOPS_MODULE_URL . '/news/article.php?storyid=' . $story->getVar('storyid'),
                'guid'        => XOOPS_MODULE_URL . '/news/article.php?storyid=' . $story->getVar('storyid'),
                'pubdate'     => $story->getVar('published'),
                'description' => $story->getVar('hometext'),
                'category' => $module[0]->getVar('name').'/'.$story->topic_title(),
            );
            if ($story->isActiveUser()) $eventArg['author'] = $story->getUname();
            $eventArgs[] = $eventArg;
        }
    }
}
?>
