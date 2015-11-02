<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/tasks')) {
                // api_get_tasks
                if (preg_match('#^/api/tasks(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_get_tasks;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_get_tasks')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\TaskController::getTasksAction',  '_format' => 'json',));
                }
                not_api_get_tasks:

                // api_get_task
                if (preg_match('#^/api/tasks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_get_task;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_get_task')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\TaskController::getTaskAction',  '_format' => 'json',));
                }
                not_api_get_task:

                // api_post_task
                if (preg_match('#^/api/tasks(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_post_task;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_post_task')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\TaskController::postTaskAction',  '_format' => 'json',));
                }
                not_api_post_task:

                // api_put_task
                if (preg_match('#^/api/tasks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_api_put_task;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_put_task')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\TaskController::putTaskAction',  '_format' => 'json',));
                }
                not_api_put_task:

                // api_delete_task
                if (preg_match('#^/api/tasks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_api_delete_task;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_delete_task')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\TaskController::deleteTaskAction',  '_format' => 'json',));
                }
                not_api_delete_task:

            }

            if (0 === strpos($pathinfo, '/api/categor')) {
                if (0 === strpos($pathinfo, '/api/categories')) {
                    // api_get_categories
                    if (preg_match('#^/api/categories(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_get_categories;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_get_categories')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\CategoryController::getCategoriesAction',  '_format' => 'json',));
                    }
                    not_api_get_categories:

                    // api_get_category
                    if (preg_match('#^/api/categories/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_get_category;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_get_category')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\CategoryController::getCategoryAction',  '_format' => 'json',));
                    }
                    not_api_get_category:

                    // api_post_category
                    if (preg_match('#^/api/categories(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_post_category;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_post_category')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\CategoryController::postCategoryAction',  '_format' => 'json',));
                    }
                    not_api_post_category:

                }

                // api_put_category
                if (0 === strpos($pathinfo, '/api/category') && preg_match('#^/api/category(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_api_put_category;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_put_category')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\CategoryController::putCategoryAction',  '_format' => 'json',));
                }
                not_api_put_category:

                // api_delete_category
                if (0 === strpos($pathinfo, '/api/categories') && preg_match('#^/api/categories/(?P<cat>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_api_delete_category;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_delete_category')), array (  '_controller' => 'Poc\\ApiBundle\\Controller\\CategoryController::deleteCategoryAction',  '_format' => 'json',));
                }
                not_api_delete_category:

            }

            // nelmio_api_doc_index
            if (0 === strpos($pathinfo, '/api/doc') && preg_match('#^/api/doc(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_nelmio_api_doc_index;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
            }
            not_nelmio_api_doc_index:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
