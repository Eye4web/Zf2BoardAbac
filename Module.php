<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Eye4web\Zf2BoardAbac;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $mvcEvent = $e;

        /** @var \Zend\Mvc\Application $target */
        $target = $e->getTarget();
        $serviceManager = $e->getApplication()->getServiceManager();

        /** @var \Zend\EventManager\SharedEventManager $eventManager */
        $eventManager = $target->getEventManager()->getSharedManager();

        /** @var \Eye4web\Zf2Abac\Service\AuthorizationService $authorizationService */
        $authorizationService = $serviceManager->get('Eye4web\Zf2Abac\Service\AuthorizationService');

        // Bind event to read topic
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'board.read', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('board.read', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });

        // Bind event to read topic
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'topic.read', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('topic.read', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });

        // Bind event to write topic
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'topic.write', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('topic.write', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });

        // Bind event to write post
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'post.write', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('post.write', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });

        // Bind event to edit post
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'post.edit', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('post.write', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });

        // Bind event to delete post
        $eventManager->attach('Eye4web\Zf2Board\Controller\BoardController', 'post.delete', function($e) use ($authorizationService, $mvcEvent) {
            $params = $e->getParams();
            $attributes = [];

            if (isset($params['attributes'])) {
                $attributes = $params['attributes'];
            }

            if (!$authorizationService->hasPermission('post.write', null, $attributes)) {
                $viewModel = $params['view'];
                $viewModel->setTemplate('error/403');
            }
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
