<?php

namespace Poc\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Poc\ApiBundle\Entity\Task;
use Poc\ApiBundle\Entity\Category;

class CategoryController extends Controller {

    private $em;

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return a list of all categories",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     * @return View
     */
    public function getCategoriesAction() {
        $categories = $this->getEntityManager()->getRepository('PocApiBundle:Category')->findAll();
        $view = View::create();
        if (!is_array($categories)) {
            $view->setData($categories)->setStatusCode(400);
        }
        $view->setData($categories)->setStatusCode(200);
        return $view;
    }

    /**
     * @ApiDoc(
     *  resource=true,
     *  description="Return a category",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     * @return View
     */
    public function getCategoryAction($id) {
        $category = $this->getEntityManager()->getRepository('PocApiBundle:Category')->find($id);
        $view = View::create();
        if (!is_object($category)) {
            $view->setData($category)->setStatusCode(400);
        }
        $view->setData($category)->setStatusCode(200);
        return $view;
    }

    /**
     * Create a Category from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new category from the submitted data.",
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
     * @RequestParam(name="color", nullable=true, strict=true, description="Color.")
     *
     * @return View
     */
    public function postCategoryAction(ParamFetcher $paramFetcher) {
        $label = filter_var($paramFetcher->get('label'), FILTER_SANITIZE_STRING);
        $desc = filter_var($paramFetcher->get('description'), FILTER_SANITIZE_STRING);
        $statusCode = 201;
        if (isset($label) && $label != '') {
//            $category = new Task();
//            $category->setLabel($label);
//            $category->setDescription($desc);
//            $category->setDate(new \DateTime('now'));
//
//            $manager = $this->getEntityManager();
//            $manager->persist($category);
//            $manager->flush();
//            $id = $category->getId();
//            if(!isset($id)) {
//                $statusCode = 400;
//            }
        } else {
            $statusCode = 400;
        }

        $view = View::create();
        $view->setData('')->setStatusCode($statusCode);
        return $view;
    }

    /**
     * Update a Category from the submitted data by ID.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Updates a category from the submitted data by ID.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param int $id
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="label", nullable=false, strict=true, description="Label.")
     * @RequestParam(name="description", nullable=true, strict=true, description="Description.")
     * @RequestParam(name="color", nullable=true, strict=true, description="Color.")
     *
     * @return View
     */
    public function putCategoryAction($id, ParamFetcher $paramFetcher) {
        //$id = $paramFetcher->get('id')

        $view = View::create();
        $view->setData('')->setStatusCode(200);
        return $view;
    }

    /**
     * Delete an category identified by id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete an category identified by id",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
    public function deleteCategoryAction($id) {

        $view = View::create();
        $view->setData('')->setStatusCode(200);
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
