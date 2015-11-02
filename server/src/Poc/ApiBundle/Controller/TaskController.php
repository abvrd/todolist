<?php

namespace Poc\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Poc\ApiBundle\Entity\Task;
use Poc\ApiBundle\Entity\Category;

class TaskController extends Controller {

    private $em;

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return a list of all tasks",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     * @return View
     */
    public function getTasksAction() {
        $tasks = $this->getEntityManager()->getRepository('PocApiBundle:Task')->findAll();
        $view = View::create();
        if (!is_array($tasks)) {
            $view->setData($tasks)->setStatusCode(400);
        }
        $view->setData($tasks)->setStatusCode(200);
        return $view;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return a task",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     * @return View
     */
    public function getTaskAction($id) {
        $idTask = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $task = $this->getEntityManager()->getRepository('PocApiBundle:Task')->find($idTask);
        $view = View::create();
        if (!is_object($task)) {
            $view->setData($task)->setStatusCode(400);
        }
        $view->setData($task)->setStatusCode(200);
        return $view;
    }

    /**
     * Create a Task from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new task from the submitted data.",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="label", nullable=false, strict=true, description="Label.")
     * @RequestParam(name="description", nullable=true, strict=true, description="Description.")
     * @RequestParam(name="categories", nullable=true, strict=true, description="Categories.")
     *
     * @return View
     */
    public function postTaskAction(ParamFetcher $paramFetcher) {
        $label = filter_var($paramFetcher->get('label'), FILTER_SANITIZE_STRING);
        $desc = filter_var($paramFetcher->get('description'), FILTER_SANITIZE_STRING);
        $categories = json_decode($paramFetcher->get('categories'));
        $statusCode = 201;

        if (isset($label) && $label != '') {
            $task = new Task();
            $task->setLabel($label);
            $task->setDescription($desc);
            $task->setDate(new \DateTime('now'));

            if (is_array($categories)) {
                foreach ($categories as $cat) {
                    $catId = filter_var($cat, FILTER_SANITIZE_NUMBER_INT);
                    $category = $this->getEntityManager()->getRepository('PocApiBundle:Category')->find($catId);
                    if (is_object($category)) {
                        $task->addCategory($category);
                    }
                }
            }

            $manager = $this->getEntityManager();
            $manager->persist($task);
            $manager->flush();
            $id = $task->getId();
            if (!isset($id)) {
                $statusCode = 400;
            }
        } else {
            $statusCode = 400;
        }

        $view = View::create();
        $view->setData($task)->setStatusCode($statusCode);
        return $view;
    }
    
    /**
     * Update a Task from the submitted data by ID.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update a task from the submitted data by ID.",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param int $id
     * @param ParamFetcher $paramFetcher Paramfetcher
     * 
     *
     * @RequestParam(name="label", nullable=false, strict=true, description="Label.")
     * @RequestParam(name="description", nullable=true, strict=true, description="Description.")
     * @RequestParam(name="categories", nullable=true, strict=true, description="Categories.")
     * @RequestParam(name="done", nullable=true, strict=true, description="Done.")
     *
     * @return View
     */
    public function putTaskAction($id, ParamFetcher $paramFetcher) {
        $idTask = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $task = $this->getEntityManager()->getRepository('PocApiBundle:Task')->find($idTask);
        $view = View::create();
        if (is_object($task)) {
            $label = filter_var($paramFetcher->get('label'), FILTER_SANITIZE_STRING);
            $desc = filter_var($paramFetcher->get('description'), FILTER_SANITIZE_STRING);
            $categories = json_decode($paramFetcher->get('categories'));
            $done = filter_var($paramFetcher->get('done'), FILTER_SANITIZE_STRING);

            if(isset($label) && $label !== '') {
                $task->setLabel($label);
            }
            if(isset($desc) && $desc !== '') {
                $task->setDescription($desc);
            }
            
            if (is_array($categories)) {
                foreach ($categories as $cat) {
                    $catId = filter_var($cat, FILTER_SANITIZE_NUMBER_INT);
                    $category = $this->getEntityManager()->getRepository('PocApiBundle:Category')->find($catId);
                    if (is_object($category)) {
                        //remove all cat and add new ones
                        //$task->addCategory($category);
                    }
                }
            }
            
            if (isset($done) && $done !== "") {
                $task->setDone(new \DateTime('now'));
            }

            $manager = $this->getEntityManager();
            $manager->merge($task);
            $manager->flush();
            $view->setData($task)->setStatusCode(204);
        } else {
            $view->setData('')->setStatusCode(400);
        }

        return $view;
    }

    /**
     * Delete an task identified by id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete an user identified by id",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param int $id 
     *
     * @return View
     */
    public function deleteTaskAction($id) {
        $idTask = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $task = $this->getEntityManager()->getRepository('PocApiBundle:Task')->find($idTask);
        $view = View::create();
        if (is_object($task)) {
            $manager = $this->getEntityManager();
            $manager->remove($task);
            $manager->flush();
            $view->setData('')->setStatusCode(200);
        }else {
            $view->setData('')->setStatusCode(400);
        }
        
        return $view;
    }

    public function getEntityManager() {
        if ($this->em === null) {
            $this->em = $this
                    ->getDoctrine()
                    ->getManager()
            //->getRepository('PocApiBundle:Movie')
            ;
        }
        return $this->em;
    }

}
