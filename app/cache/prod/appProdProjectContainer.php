<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class appProdProjectContainer extends Container
{
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->set('service_container', $this);
        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
    }
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/annotations', false);
    }
    protected function getAssetic_AssetManagerService()
    {
        $a = $this->get('templating.loader');
        $this->services['assetic.asset_manager'] = $instance = new \Assetic\Factory\LazyAssetManager($this->get('assetic.asset_factory'), array('twig' => new \Assetic\Factory\Loader\CachedFormulaLoader(new \Assetic\Extension\Twig\TwigFormulaLoader($this->get('twig')), new \Assetic\Cache\ConfigCache('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/assetic/config'), false)));
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FMElfinderBundle', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/FMElfinderBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FMElfinderBundle', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/helios-ag/fm-elfinder-bundle/FM/ElfinderBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, '', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/views', '/\\.[^.]+\\.twig$/'), 'twig');
        return $instance;
    }
    protected function getAssetic_Filter_CssrewriteService()
    {
        return $this->services['assetic.filter.cssrewrite'] = new \Assetic\Filter\CssRewriteFilter();
    }
    protected function getAssetic_Filter_YuiCssService()
    {
        $this->services['assetic.filter.yui_css'] = $instance = new \Assetic\Filter\Yui\CssCompressorFilter('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/java/yuicompressor-2.4.7.jar', '/usr/bin/java');
        $instance->setCharset('UTF-8');
        $instance->setTimeout(NULL);
        $instance->setStackSize(NULL);
        return $instance;
    }
    protected function getAssetic_Filter_YuiJsService()
    {
        $this->services['assetic.filter.yui_js'] = $instance = new \Assetic\Filter\Yui\JsCompressorFilter('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/java/yuicompressor-2.4.7.jar', '/usr/bin/java');
        $instance->setCharset('UTF-8');
        $instance->setTimeout(NULL);
        $instance->setStackSize(NULL);
        $instance->setNomunge(NULL);
        $instance->setPreserveSemi(NULL);
        $instance->setDisableOptimizations(NULL);
        return $instance;
    }
    protected function getAssetic_FilterManagerService()
    {
        return $this->services['assetic.filter_manager'] = new \Symfony\Bundle\AsseticBundle\FilterManager($this, array('cssrewrite' => 'assetic.filter.cssrewrite', 'yui_css' => 'assetic.filter.yui_css', 'yui_js' => 'assetic.filter.yui_js'));
    }
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array(0 => $this->get('liip_imagine.cache.clearer')));
    }
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.filename_parser');
        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources');
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetManagerCacheWarmer($this), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('router')), 3 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 4 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine')), 5 => new \JMS\DiExtraBundle\HttpKernel\ControllerInjectorsWarmer($a, $this->get('jms_di_extra.controller_resolver'))));
    }
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array());
    }
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
        $a->addEventSubscriber($this->get('gedmo.listener.sluggable'));
        $a->addEventSubscriber(new \FOS\UserBundle\Doctrine\Orm\UserListener($this));
        $a->addEventListener(array(0 => 'postGenerateSchema'), 'security.acl.dbal.schema_listener');
        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('dbname' => 'ArrasFilmFestival', 'host' => '127.0.0.1', 'port' => NULL, 'user' => 'root', 'password' => NULL, 'charset' => 'UTF8', 'driver' => 'pdo_mysql', 'driverOptions' => array()), new \Doctrine\DBAL\Configuration(), $a, array());
    }
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        require_once '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_diextra/doctrine/EntityManager_51dedf6753d41.php';
        $a = new \Doctrine\Common\Cache\ArrayCache();
        $a->setNamespace('sf2orm_default_5a02fca80e983306866d6b3a11fea7ee');
        $b = new \Doctrine\Common\Cache\ArrayCache();
        $b->setNamespace('sf2orm_default_5a02fca80e983306866d6b3a11fea7ee');
        $c = new \Doctrine\Common\Cache\ArrayCache();
        $c->setNamespace('sf2orm_default_5a02fca80e983306866d6b3a11fea7ee');
        $d = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver(array('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/doctrine' => 'FOS\\UserBundle\\Entity'));
        $d->setGlobalBasename('mapping');
        $e = new \Doctrine\ORM\Mapping\Driver\DriverChain();
        $e->addDriver(new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($this->get('annotation_reader'), array(0 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/src/ArrasFilmFestival/BackOfficeBundle/Entity')), 'ArrasFilmFestival\\BackOfficeBundle\\Entity');
        $e->addDriver($d, 'FOS\\UserBundle\\Entity');
        $e->addDriver(new \Doctrine\ORM\Mapping\Driver\XmlDriver(new \Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator(array('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/doctrine/model' => 'FOS\\UserBundle\\Model'), '.orm.xml')), 'FOS\\UserBundle\\Model');
        $f = new \Doctrine\ORM\Configuration();
        $f->setEntityNamespaces(array('BackOfficeBundle' => 'ArrasFilmFestival\\BackOfficeBundle\\Entity', 'FOSUserBundle' => 'FOS\\UserBundle\\Entity'));
        $f->setMetadataCacheImpl($a);
        $f->setQueryCacheImpl($b);
        $f->setResultCacheImpl($c);
        $f->setMetadataDriverImpl($e);
        $f->setProxyDir('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/doctrine/orm/Proxies');
        $f->setProxyNamespace('Proxies');
        $f->setAutoGenerateProxyClasses(false);
        $f->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $f->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $f->setNamingStrategy(new \Doctrine\ORM\Mapping\DefaultNamingStrategy());
        $g = call_user_func(array('Doctrine\\ORM\\EntityManager', 'create'), $this->get('doctrine.dbal.default_connection'), $f);
        $this->get('doctrine.orm.default_manager_configurator')->configure($g);
        return $this->services['doctrine.orm.default_entity_manager'] = new \EntityManager51dedf6753d41_546a8d27f194334ee012bfe64f629947b07e4919\__CG__\Doctrine\ORM\EntityManager($g, $this);
    }
    protected function getDoctrine_Orm_DefaultManagerConfiguratorService()
    {
        return $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array());
    }
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer($this->get('doctrine'));
    }
    protected function getElfinderLoaderService()
    {
        return $this->services['elfinder_loader'] = new \FM\ElfinderBundle\Loader\FMElfinderLoader($this);
    }
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'before'), 0);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'pagination'), 0);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.sortable', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.filtration', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'pagination'), 1);
        $instance->addListenerService('kernel.request', array(0 => 'security.firewall', 1 => 'onKernelRequest'), 8);
        $instance->addListenerService('kernel.response', array(0 => 'security.rememberme.response_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.controller.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.converter.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.view.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.view', array(0 => 'sensio_framework_extra.view.listener', 1 => 'onKernelView'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sensio_framework_extra.cache.listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'onKernelRequest'), 0);
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('session_listener', 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');
        $instance->addSubscriberService('twig.exception_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener');
        $instance->addSubscriberService('swiftmailer.email_sender.listener', 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener');
        $instance->addSubscriberService('fos_user.security.interactive_login_listener', 'FOS\\UserBundle\\EventListener\\LastLoginListener');
        $instance->addSubscriberService('fos_user.listener.authentication', 'FOS\\UserBundle\\EventListener\\AuthenticationListener');
        $instance->addSubscriberService('fos_user.listener.flash', 'FOS\\UserBundle\\EventListener\\FlashListener');
        $instance->addSubscriberService('fos_user.listener.resetting', 'FOS\\UserBundle\\EventListener\\ResettingListener');
        return $instance;
    }
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources');
    }
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider($this->get('session'), 'ThisTokenIsNotSoSecretChangeIt');
    }
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory($this->get('form.registry'), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_RegistryService()
    {
        return $this->services['form.registry'] = new \Symfony\Component\Form\FormRegistry(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('field' => 'form.type.field', 'form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'entity' => 'form.type.entity', 'ckeditor' => 'ivory_ck_editor.form.type', 'fos_user_username' => 'fos_user.username_form_type', 'fos_user_profile' => 'fos_user.profile.form.type', 'fos_user_registration' => 'fos_user.registration.form.type', 'fos_user_change_password' => 'fos_user.change_password.form.type', 'fos_user_resetting' => 'fos_user.resetting.form.type', 'fos_user_group' => 'fos_user.group.form.type', 'liip_imagine_image' => 'liip_imagine.form.type.image'), array('form' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.csrf'), 'repeated' => array(0 => 'form.type_extension.repeated.validator')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_ResolvedTypeFactoryService()
    {
        return $this->services['form.resolved_type_factory'] = new \Symfony\Component\Form\ResolvedFormTypeFactory();
    }
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }
    protected function getForm_Type_FieldService()
    {
        return $this->services['form.type.field'] = new \Symfony\Component\Form\Extension\Core\Type\FieldType();
    }
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType();
    }
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension($this->get('form.csrf_provider'), true, '_token');
    }
    protected function getForm_TypeExtension_Form_HttpFoundationService()
    {
        return $this->services['form.type_extension.form.http_foundation'] = new \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension();
    }
    protected function getForm_TypeExtension_Form_ValidatorService()
    {
        return $this->services['form.type_extension.form.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension($this->get('validator'));
    }
    protected function getForm_TypeExtension_Repeated_ValidatorService()
    {
        return $this->services['form.type_extension.repeated.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension();
    }
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator.mapping.class_metadata_factory'));
    }
    protected function getFosUser_ChangePassword_Form_FactoryService()
    {
        return $this->services['fos_user.change_password.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_change_password_form', 'fos_user_change_password', array(0 => 'ChangePassword', 1 => 'Default'));
    }
    protected function getFosUser_ChangePassword_Form_TypeService()
    {
        return $this->services['fos_user.change_password.form.type'] = new \FOS\UserBundle\Form\Type\ChangePasswordFormType('ArrasFilmFestival\\BackOfficeBundle\\Entity\\User');
    }
    protected function getFosUser_Group_Form_FactoryService()
    {
        return $this->services['fos_user.group.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_group_form', 'fos_user_group', array(0 => 'Registration', 1 => 'Default'));
    }
    protected function getFosUser_Group_Form_TypeService()
    {
        return $this->services['fos_user.group.form.type'] = new \FOS\UserBundle\Form\Type\GroupFormType('ArrasFilmFestival\\BackOfficeBundle\\Entity\\Group');
    }
    protected function getFosUser_GroupManagerService()
    {
        return $this->services['fos_user.group_manager'] = new \FOS\UserBundle\Doctrine\GroupManager($this->get('fos_user.entity_manager'), 'ArrasFilmFestival\\BackOfficeBundle\\Entity\\Group');
    }
    protected function getFosUser_Listener_AuthenticationService()
    {
        return $this->services['fos_user.listener.authentication'] = new \FOS\UserBundle\EventListener\AuthenticationListener($this->get('fos_user.security.login_manager'), 'main');
    }
    protected function getFosUser_Listener_FlashService()
    {
        return $this->services['fos_user.listener.flash'] = new \FOS\UserBundle\EventListener\FlashListener($this->get('session'), $this->get('translator.default'));
    }
    protected function getFosUser_Listener_ResettingService()
    {
        return $this->services['fos_user.listener.resetting'] = new \FOS\UserBundle\EventListener\ResettingListener($this->get('router'), 86400);
    }
    protected function getFosUser_MailerService()
    {
        return $this->services['fos_user.mailer'] = new \FOS\UserBundle\Mailer\Mailer($this->get('mailer'), $this->get('router'), $this->get('templating'), array('confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig', 'resetting.template' => 'FOSUserBundle:Resetting:email.txt.twig', 'from_email' => array('confirmation' => array('webmaster@example.com' => 'webmaster'), 'resetting' => array('webmaster@example.com' => 'webmaster'))));
    }
    protected function getFosUser_Profile_Form_FactoryService()
    {
        return $this->services['fos_user.profile.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_profile_form', 'fos_user_profile', array(0 => 'Profile', 1 => 'Default'));
    }
    protected function getFosUser_Profile_Form_TypeService()
    {
        return $this->services['fos_user.profile.form.type'] = new \FOS\UserBundle\Form\Type\ProfileFormType('ArrasFilmFestival\\BackOfficeBundle\\Entity\\User');
    }
    protected function getFosUser_Registration_Form_FactoryService()
    {
        return $this->services['fos_user.registration.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_registration_form', 'fos_user_registration', array(0 => 'Registration', 1 => 'Default'));
    }
    protected function getFosUser_Registration_Form_TypeService()
    {
        return $this->services['fos_user.registration.form.type'] = new \FOS\UserBundle\Form\Type\RegistrationFormType('ArrasFilmFestival\\BackOfficeBundle\\Entity\\User');
    }
    protected function getFosUser_Resetting_Form_FactoryService()
    {
        return $this->services['fos_user.resetting.form.factory'] = new \FOS\UserBundle\Form\Factory\FormFactory($this->get('form.factory'), 'fos_user_resetting_form', 'fos_user_resetting', array(0 => 'ResetPassword', 1 => 'Default'));
    }
    protected function getFosUser_Resetting_Form_TypeService()
    {
        return $this->services['fos_user.resetting.form.type'] = new \FOS\UserBundle\Form\Type\ResettingFormType('ArrasFilmFestival\\BackOfficeBundle\\Entity\\User');
    }
    protected function getFosUser_Security_InteractiveLoginListenerService()
    {
        return $this->services['fos_user.security.interactive_login_listener'] = new \FOS\UserBundle\EventListener\LastLoginListener($this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Security_LoginManagerService()
    {
        return $this->services['fos_user.security.login_manager'] = new \FOS\UserBundle\Security\LoginManager($this->get('security.context'), $this->get('security.user_checker'), $this->get('security.authentication.session_strategy'), $this);
    }
    protected function getFosUser_UserManagerService()
    {
        $a = $this->get('fos_user.util.email_canonicalizer');
        return $this->services['fos_user.user_manager'] = new \FOS\UserBundle\Doctrine\UserManager($this->get('security.encoder_factory'), $a, $a, $this->get('fos_user.entity_manager'), 'ArrasFilmFestival\\BackOfficeBundle\\Entity\\User');
    }
    protected function getFosUser_UsernameFormTypeService()
    {
        return $this->services['fos_user.username_form_type'] = new \FOS\UserBundle\Form\Type\UsernameFormType(new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($this->get('fos_user.user_manager')));
    }
    protected function getFosUser_Util_EmailCanonicalizerService()
    {
        return $this->services['fos_user.util.email_canonicalizer'] = new \FOS\UserBundle\Util\Canonicalizer();
    }
    protected function getFosUser_Util_TokenGeneratorService()
    {
        return $this->services['fos_user.util.token_generator'] = new \FOS\UserBundle\Util\TokenGenerator($this->get('logger'));
    }
    protected function getFosUser_Util_UserManipulatorService()
    {
        return $this->services['fos_user.util.user_manipulator'] = new \FOS\UserBundle\Util\UserManipulator($this->get('fos_user.user_manager'));
    }
    protected function getGedmo_Listener_SluggableService()
    {
        $this->services['gedmo.listener.sluggable'] = $instance = new \Gedmo\Sluggable\SluggableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Bundle\FrameworkBundle\HttpKernel($this->get('event_dispatcher'), $this, $this->get('jms_di_extra.controller_resolver'));
    }
    protected function getIvoryCkEditor_ConfigManagerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('ivory_ck_editor.config_manager', 'request');
        }
        return $this->services['ivory_ck_editor.config_manager'] = $this->scopedServices['request']['ivory_ck_editor.config_manager'] = new \Ivory\CKEditorBundle\Model\ConfigManager($this->get('templating.helper.assets'), $this->get('ivory_ck_editor.helper.assets_version_trimer'), $this->get('router'));
    }
    protected function getIvoryCkEditor_Form_TypeService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('ivory_ck_editor.form.type', 'request');
        }
        return $this->services['ivory_ck_editor.form.type'] = $this->scopedServices['request']['ivory_ck_editor.form.type'] = new \Ivory\CKEditorBundle\Form\Type\CKEditorType(true, 'bundles/ivoryckeditor/', 'bundles/ivoryckeditor/ckeditor.js', $this->get('ivory_ck_editor.config_manager'), $this->get('ivory_ck_editor.plugin_manager'), $this->get('templating.helper.assets'), $this->get('ivory_ck_editor.helper.assets_version_trimer'));
    }
    protected function getIvoryCkEditor_Helper_AssetsVersionTrimerService()
    {
        return $this->services['ivory_ck_editor.helper.assets_version_trimer'] = new \Ivory\CKEditorBundle\Helper\AssetsVersionTrimerHelper();
    }
    protected function getIvoryCkEditor_PluginManagerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('ivory_ck_editor.plugin_manager', 'request');
        }
        return $this->services['ivory_ck_editor.plugin_manager'] = $this->scopedServices['request']['ivory_ck_editor.plugin_manager'] = new \Ivory\CKEditorBundle\Model\PluginManager($this->get('templating.helper.assets'), $this->get('ivory_ck_editor.helper.assets_version_trimer'));
    }
    protected function getJmsAop_InterceptorLoaderService()
    {
        return $this->services['jms_aop.interceptor_loader'] = new \JMS\AopBundle\Aop\InterceptorLoader($this, array());
    }
    protected function getJmsAop_PointcutContainerService()
    {
        return $this->services['jms_aop.pointcut_container'] = new \JMS\AopBundle\Aop\PointcutContainer(array('security.access.method_interceptor' => $this->get('security.access.pointcut')));
    }
    protected function getJmsDiExtra_Metadata_ConverterService()
    {
        return $this->services['jms_di_extra.metadata.converter'] = new \JMS\DiExtraBundle\Metadata\MetadataConverter();
    }
    protected function getJmsDiExtra_Metadata_MetadataFactoryService()
    {
        $this->services['jms_di_extra.metadata.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'jms_di_extra.metadata_driver'), 'Metadata\\ClassHierarchyMetadata', false);
        $instance->setCache(new \Metadata\Cache\FileCache('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_diextra/metadata'));
        return $instance;
    }
    protected function getJmsDiExtra_MetadataDriverService()
    {
        return $this->services['jms_di_extra.metadata_driver'] = new \JMS\DiExtraBundle\Metadata\Driver\AnnotationDriver($this->get('annotation_reader'));
    }
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }
    protected function getKnpPaginatorService()
    {
        $this->services['knp_paginator'] = $instance = new \Knp\Component\Pager\Paginator($this->get('event_dispatcher'));
        $instance->setDefaultPaginatorOptions(array('pageParameterName' => 'page', 'sortFieldParameterName' => 'sort', 'sortDirectionParameterName' => 'direction', 'filterFieldParameterName' => 'filterField', 'filterValueParameterName' => 'filterValue', 'distinct' => true));
        return $instance;
    }
    protected function getKnpPaginator_Helper_ProcessorService()
    {
        return $this->services['knp_paginator.helper.processor'] = new \Knp\Bundle\PaginatorBundle\Helper\Processor($this->get('templating.helper.router'), $this->get('translator.default'));
    }
    protected function getKnpPaginator_Subscriber_FiltrationService()
    {
        return $this->services['knp_paginator.subscriber.filtration'] = new \Knp\Component\Pager\Event\Subscriber\Filtration\FiltrationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_PaginateService()
    {
        return $this->services['knp_paginator.subscriber.paginate'] = new \Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_SlidingPaginationService()
    {
        return $this->services['knp_paginator.subscriber.sliding_pagination'] = new \Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber(array('defaultPaginationTemplate' => 'KnpPaginatorBundle:Pagination:sliding.html.twig', 'defaultSortableTemplate' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig', 'defaultFiltrationTemplate' => 'KnpPaginatorBundle:Pagination:filtration.html.twig', 'defaultPageRange' => 5));
    }
    protected function getKnpPaginator_Subscriber_SortableService()
    {
        return $this->services['knp_paginator.subscriber.sortable'] = new \Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber();
    }
    protected function getKnpPaginator_Templating_Helper_PaginationService()
    {
        return $this->services['knp_paginator.templating.helper.pagination'] = new \Knp\Bundle\PaginatorBundle\Templating\PaginationHelper($this->get('knp_paginator.helper.processor'), $this->get('templating.engine.php'));
    }
    protected function getKnpPaginator_Twig_Extension_PaginationService()
    {
        return $this->services['knp_paginator.twig.extension.pagination'] = new \Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension($this->get('knp_paginator.helper.processor'));
    }
    protected function getLiipImagineService()
    {
        return $this->services['liip_imagine'] = new \Imagine\Gd\Imagine();
    }
    protected function getLiipImagine_Cache_ClearerService()
    {
        return $this->services['liip_imagine.cache.clearer'] = new \Liip\ImagineBundle\Imagine\Cache\CacheClearer($this->get('liip_imagine.cache.manager'), '/media/cache');
    }
    protected function getLiipImagine_Cache_ManagerService()
    {
        $this->services['liip_imagine.cache.manager'] = $instance = new \Liip\ImagineBundle\Imagine\Cache\CacheManager($this->get('liip_imagine.filter.configuration'), $this->get('router'), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web', 'web_path');
        $instance->addResolver('web_path', $this->get('liip_imagine.cache.resolver.web_path'));
        $instance->addResolver('no_cache', $this->get('liip_imagine.cache.resolver.no_cache'));
        return $instance;
    }
    protected function getLiipImagine_Cache_Resolver_NoCacheService()
    {
        return $this->services['liip_imagine.cache.resolver.no_cache'] = new \Liip\ImagineBundle\Imagine\Cache\Resolver\NoCacheResolver($this->get('filesystem'));
    }
    protected function getLiipImagine_Cache_Resolver_WebPathService()
    {
        $this->services['liip_imagine.cache.resolver.web_path'] = $instance = new \Liip\ImagineBundle\Imagine\Cache\Resolver\WebPathResolver($this->get('filesystem'));
        $instance->setBasePath('');
        $instance->setFolderPermissions(511);
        return $instance;
    }
    protected function getLiipImagine_ControllerService()
    {
        return $this->services['liip_imagine.controller'] = new \Liip\ImagineBundle\Controller\ImagineController($this->get('liip_imagine.data.manager'), $this->get('liip_imagine.filter.manager'), $this->get('liip_imagine.cache.manager'));
    }
    protected function getLiipImagine_Data_Loader_FilesystemService()
    {
        return $this->services['liip_imagine.data.loader.filesystem'] = new \Liip\ImagineBundle\Imagine\Data\Loader\FileSystemLoader($this->get('liip_imagine'), array(), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web');
    }
    protected function getLiipImagine_Data_ManagerService()
    {
        $this->services['liip_imagine.data.manager'] = $instance = new \Liip\ImagineBundle\Imagine\Data\DataManager($this->get('liip_imagine.filter.configuration'), 'filesystem');
        $instance->addLoader('filesystem', $this->get('liip_imagine.data.loader.filesystem'));
        return $instance;
    }
    protected function getLiipImagine_Filter_ConfigurationService()
    {
        return $this->services['liip_imagine.filter.configuration'] = new \Liip\ImagineBundle\Imagine\Filter\FilterConfiguration(array('back_thumb' => array('filters' => array('thumbnail' => array('size' => array(0 => 290, 1 => 200), 'mode' => 'outbound')), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array()), 'front_thumb' => array('filters' => array('thumbnail' => array('size' => array(0 => 280, 1 => 180), 'mode' => 'outbound')), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array()), 'front_widen' => array('filters' => array('relative_resize' => array('widen' => 500)), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array())));
    }
    protected function getLiipImagine_Filter_Loader_BackgroundService()
    {
        return $this->services['liip_imagine.filter.loader.background'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\BackgroundFilterLoader($this->get('liip_imagine'));
    }
    protected function getLiipImagine_Filter_Loader_CropService()
    {
        return $this->services['liip_imagine.filter.loader.crop'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\CropFilterLoader();
    }
    protected function getLiipImagine_Filter_Loader_PasteService()
    {
        return $this->services['liip_imagine.filter.loader.paste'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\PasteFilterLoader($this->get('liip_imagine'), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app');
    }
    protected function getLiipImagine_Filter_Loader_RelativeResizeService()
    {
        return $this->services['liip_imagine.filter.loader.relative_resize'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\RelativeResizeFilterLoader();
    }
    protected function getLiipImagine_Filter_Loader_ResizeService()
    {
        return $this->services['liip_imagine.filter.loader.resize'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\ResizeFilterLoader();
    }
    protected function getLiipImagine_Filter_Loader_StripService()
    {
        return $this->services['liip_imagine.filter.loader.strip'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\StripFilterLoader();
    }
    protected function getLiipImagine_Filter_Loader_ThumbnailService()
    {
        return $this->services['liip_imagine.filter.loader.thumbnail'] = new \Liip\ImagineBundle\Imagine\Filter\Loader\ThumbnailFilterLoader();
    }
    protected function getLiipImagine_Filter_ManagerService()
    {
        $this->services['liip_imagine.filter.manager'] = $instance = new \Liip\ImagineBundle\Imagine\Filter\FilterManager($this->get('liip_imagine.filter.configuration'));
        $instance->addLoader('relative_resize', $this->get('liip_imagine.filter.loader.relative_resize'));
        $instance->addLoader('resize', $this->get('liip_imagine.filter.loader.resize'));
        $instance->addLoader('thumbnail', $this->get('liip_imagine.filter.loader.thumbnail'));
        $instance->addLoader('crop', $this->get('liip_imagine.filter.loader.crop'));
        $instance->addLoader('paste', $this->get('liip_imagine.filter.loader.paste'));
        $instance->addLoader('background', $this->get('liip_imagine.filter.loader.background'));
        $instance->addLoader('strip', $this->get('liip_imagine.filter.loader.strip'));
        return $instance;
    }
    protected function getLiipImagine_Form_Type_ImageService()
    {
        return $this->services['liip_imagine.form.type.image'] = new \Liip\ImagineBundle\Form\Type\ImageType();
    }
    protected function getLiipImagine_Routing_LoaderService()
    {
        return $this->services['liip_imagine.routing.loader'] = new \Liip\ImagineBundle\Routing\ImagineLoader('liip_imagine.controller:filterAction', '/media/cache', array('back_thumb' => array('filters' => array('thumbnail' => array('size' => array(0 => 290, 1 => 200), 'mode' => 'outbound')), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array()), 'front_thumb' => array('filters' => array('thumbnail' => array('size' => array(0 => 280, 1 => 180), 'mode' => 'outbound')), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array()), 'front_widen' => array('filters' => array('relative_resize' => array('widen' => 500)), 'quality' => 100, 'format' => NULL, 'cache' => NULL, 'data_loader' => NULL, 'controller_action' => NULL, 'route' => array())));
    }
    protected function getLiipImagine_Templating_HelperService()
    {
        return $this->services['liip_imagine.templating.helper'] = new \Liip\ImagineBundle\Templating\Helper\ImagineHelper($this->get('liip_imagine.cache.manager'));
    }
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('fr', $this->get('router'));
    }
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMailerService()
    {
        return $this->services['mailer'] = new \Swift_Mailer($this->get('swiftmailer.transport'));
    }
    protected function getMonolog_Handler_MainService()
    {
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\FingersCrossedHandler($this->get('monolog.handler.nested'), 400, 0, true, true);
    }
    protected function getMonolog_Handler_NestedService()
    {
        return $this->services['monolog.handler.nested'] = new \Monolog\Handler\StreamHandler('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/logs/prod.log', 100, true);
    }
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RouterService()
    {
        $this->services['monolog.logger.router'] = $instance = new \Symfony\Bridge\Monolog\Logger('router');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_SecurityService()
    {
        $this->services['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }
        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }
    protected function getRouterService()
    {
        return $this->services['router'] = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/config/routing.yml', array('cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod', 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appProdUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appProdUrlMatcher', 'strict_requirements' => false), $this->get('router.request_context'), $this->get('monolog.logger.router'));
    }
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('router'), $this->get('router.request_context'), $this->get('monolog.logger.request'));
    }
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');
        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);
        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('liip_imagine.routing.loader'));
        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router'), $d);
    }
    protected function getSecurity_Access_MethodInterceptorService()
    {
        return $this->services['security.access.method_interceptor'] = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AfterInvocationManager(array(0 => new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AclAfterInvocationProvider($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map')))), new \JMS\SecurityExtraBundle\Security\Authorization\RunAsManager('RunAsToken', 'ROLE_'), $this->get('security.extra.metadata_factory'), $this->get('monolog.logger.security'));
    }
    protected function getSecurity_Access_PointcutService()
    {
        $this->services['security.access.pointcut'] = $instance = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\SecurityPointcut($this->get('security.extra.metadata_factory'), false, array());
        $instance->setSecuredClasses(array());
        return $instance;
    }
    protected function getSecurity_Acl_Dbal_SchemaService()
    {
        return $this->services['security.acl.dbal.schema'] = new \Symfony\Component\Security\Acl\Dbal\Schema(array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), $this->get('doctrine.dbal.default_connection'));
    }
    protected function getSecurity_Acl_Dbal_SchemaListenerService()
    {
        return $this->services['security.acl.dbal.schema_listener'] = new \Symfony\Bundle\SecurityBundle\EventListener\AclSchemaListener($this);
    }
    protected function getSecurity_Acl_PermissionEvaluatorService()
    {
        return $this->services['security.acl.permission_evaluator'] = new \JMS\SecurityExtraBundle\Security\Acl\Expression\PermissionEvaluator($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map'), $this->get('monolog.logger.security'));
    }
    protected function getSecurity_Acl_ProviderService()
    {
        return $this->services['security.acl.provider'] = new \Symfony\Component\Security\Acl\Dbal\MutableAclProvider($this->get('doctrine.dbal.default_connection'), new \Symfony\Component\Security\Acl\Domain\PermissionGrantingStrategy(), array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), NULL);
    }
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }
    protected function getSecurity_ContextService()
    {
        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array('FOS\\UserBundle\\Model\\UserInterface' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder', 'arguments' => array(0 => 'sha512', 1 => true, 2 => 5000))));
    }
    protected function getSecurity_Expressions_CompilerService()
    {
        $a = new \JMS\SecurityExtraBundle\Security\Authorization\Expression\Compiler\ContainerAwareVariableCompiler();
        $a->setMaps(array('trust_resolver' => 'security.authentication.trust_resolver', 'role_hierarchy' => 'security.role_hierarchy', 'permission_evaluator' => 'security.acl.permission_evaluator'), array());
        $this->services['security.expressions.compiler'] = $instance = new \JMS\SecurityExtraBundle\Security\Authorization\Expression\ExpressionCompiler();
        $instance->addFunctionCompiler(new \JMS\SecurityExtraBundle\Security\Acl\Expression\HasPermissionFunctionCompiler());
        $instance->addTypeCompiler(new \JMS\SecurityExtraBundle\Security\Authorization\Expression\Compiler\ParameterExpressionCompiler());
        $instance->addTypeCompiler($a);
        return $instance;
    }
    protected function getSecurity_Extra_MetadataDriverService()
    {
        return $this->services['security.extra.metadata_driver'] = new \Metadata\Driver\DriverChain(array(0 => new \JMS\SecurityExtraBundle\Metadata\Driver\AnnotationDriver($this->get('annotation_reader'))));
    }
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.main' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/'))), $this->get('event_dispatcher'));
    }
    protected function getSecurity_Firewall_Map_Context_MainService()
    {
        $a = $this->get('monolog.logger.security');
        $b = $this->get('security.context');
        $c = $this->get('event_dispatcher');
        $d = $this->get('router');
        $e = $this->get('http_kernel');
        $f = $this->get('security.authentication.manager');
        $g = new \Symfony\Component\HttpFoundation\RequestMatcher('^/login');
        $h = new \Symfony\Component\HttpFoundation\RequestMatcher('^/register');
        $i = new \Symfony\Component\HttpFoundation\RequestMatcher('^/resetting');
        $j = new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/event/');
        $k = new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/gestion/');
        $l = new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/info');
        $m = new \Symfony\Component\HttpFoundation\RequestMatcher('/admin/');
        $n = new \Symfony\Component\HttpFoundation\RequestMatcher('^/efconnect');
        $o = new \Symfony\Component\HttpFoundation\RequestMatcher('^/elfinder');
        $p = new \Symfony\Component\Security\Http\AccessMap();
        $p->add($g, array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $p->add($h, array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $p->add($i, array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $p->add($j, array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $p->add($k, array(0 => 'ROLE_SUPER_ADMIN'), NULL);
        $p->add($l, array(0 => 'ROLE_POLECOM'), NULL);
        $p->add($m, array(0 => 'ROLE_USER'), NULL);
        $p->add($n, array(0 => 'ROLE_USER'), NULL);
        $p->add($o, array(0 => 'ROLE_USER'), NULL);
        $q = new \Symfony\Component\Security\Http\HttpUtils($d, $d);
        $r = new \Symfony\Component\Security\Http\Firewall\LogoutListener($b, $q, new \Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler($q, '/'), array('csrf_parameter' => '_csrf_token', 'intention' => 'logout', 'logout_path' => '/logout'));
        $r->addHandler(new \Symfony\Component\Security\Http\Logout\SessionLogoutHandler());
        $s = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler($q, array('always_use_default_target_path' => false, 'default_target_path' => '/', 'login_path' => '/login', 'target_path_parameter' => '_target_path', 'use_referer' => false));
        $s->setProviderKey('main');
        return $this->services['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => new \Symfony\Component\Security\Http\Firewall\ChannelListener($p, new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $a), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($b, array(0 => $this->get('fos_user.user_provider.username')), 'main', $a, $c), 2 => $r, 3 => new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($b, $f, $this->get('security.authentication.session_strategy'), $q, 'main', $s, new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler($e, $q, array('login_path' => '/login', 'failure_path' => NULL, 'failure_forward' => false), $a), array('check_path' => '/login_check', 'use_forward' => false, 'username_parameter' => '_username', 'password_parameter' => '_password', 'csrf_parameter' => '_csrf_token', 'intention' => 'authenticate', 'post_only' => true), $a, $c, $this->get('form.csrf_provider')), 4 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($b, '51dedf673c196', $a), 5 => new \Symfony\Component\Security\Http\Firewall\AccessListener($b, $this->get('security.access.decision_manager'), $p, $f, $a)), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($b, $this->get('security.authentication.trust_resolver'), $q, 'main', new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($e, $q, '/login', false), NULL, NULL, $a));
    }
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener();
    }
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array('ROLE_BAUDIMONT' => array(0 => 'ROLE_USER'), 'ROLE_POLECOM' => array(0 => 'ROLE_USER'), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_ADMIN', 1 => 'ROLE_POLECOM')));
    }
    protected function getSecurity_Validator_UserPasswordService()
    {
        return $this->services['security.validator.user_password'] = new \Symfony\Component\Security\Core\Validator\Constraint\UserPasswordValidator($this->get('security.context'), $this->get('security.encoder_factory'));
    }
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener();
    }
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }
    protected function getSensioFrameworkExtra_Converter_DatetimeService()
    {
        return $this->services['sensio_framework_extra.converter.datetime'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter();
    }
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine'));
    }
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'));
    }
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0, 'doctrine.orm');
        $instance->add($this->get('sensio_framework_extra.converter.datetime'), 0, 'datetime');
        return $instance;
    }
    protected function getSensioFrameworkExtra_View_GuesserService()
    {
        return $this->services['sensio_framework_extra.view.guesser'] = new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser($this->get('kernel'));
    }
    protected function getSensioFrameworkExtra_View_ListenerService()
    {
        return $this->services['sensio_framework_extra.view.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener($this);
    }
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session\Session($this->get('session.storage.native'), new \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag(), new \Symfony\Component\HttpFoundation\Session\Flash\FlashBag());
    }
    protected function getSession_HandlerService()
    {
        return $this->services['session.handler'] = new \Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/sessions');
    }
    protected function getSession_Storage_FilesystemService()
    {
        return $this->services['session.storage.filesystem'] = new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/sessions');
    }
    protected function getSession_Storage_NativeService()
    {
        return $this->services['session.storage.native'] = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array(), $this->get('session.handler'));
    }
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this);
    }
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }
    protected function getSwiftmailer_EmailSender_ListenerService()
    {
        return $this->services['swiftmailer.email_sender.listener'] = new \Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener($this);
    }
    protected function getSwiftmailer_Plugin_MessageloggerService()
    {
        return $this->services['swiftmailer.plugin.messagelogger'] = new \Swift_Plugins_MessageLogger();
    }
    protected function getSwiftmailer_SpoolService()
    {
        return $this->services['swiftmailer.spool'] = new \Swift_MemorySpool();
    }
    protected function getSwiftmailer_TransportService()
    {
        return $this->services['swiftmailer.transport'] = new \Swift_Transport_SpoolTransport($this->get('swiftmailer.transport.eventdispatcher'), $this->get('swiftmailer.spool'));
    }
    protected function getSwiftmailer_Transport_RealService()
    {
        $this->services['swiftmailer.transport.real'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()))), $this->get('swiftmailer.transport.eventdispatcher'));
        $instance->setHost('127.0.0.1');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setUsername(NULL);
        $instance->setPassword(NULL);
        $instance->setAuthMode(NULL);
        $instance->setTimeout(30);
        $instance->setSourceIp(NULL);
        return $instance;
    }
    protected function getTemplatingService()
    {
        $this->services['templating'] = $instance = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.locator'));
        $instance->setDefaultEscapingStrategy(array(0 => $instance, 1 => 'guessDefaultEscapingStrategy'));
        return $instance;
    }
    protected function getTemplating_Asset_PackageFactoryService()
    {
        return $this->services['templating.asset.package_factory'] = new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory($this);
    }
    protected function getTemplating_FilenameParserService()
    {
        return $this->services['templating.filename_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser();
    }
    protected function getTemplating_GlobalsService()
    {
        return $this->services['templating.globals'] = new \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables($this);
    }
    protected function getTemplating_Helper_ActionsService()
    {
        return $this->services['templating.helper.actions'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper($this->get('http_kernel'));
    }
    protected function getTemplating_Helper_AssetsService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('templating.helper.assets', 'request');
        }
        return $this->services['templating.helper.assets'] = $this->scopedServices['request']['templating.helper.assets'] = new \Symfony\Component\Templating\Helper\CoreAssetsHelper(new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PathPackage($this->get('request'), NULL, '%s?%s'), array());
    }
    protected function getTemplating_Helper_CodeService()
    {
        return $this->services['templating.helper.code'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper(NULL, '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app', 'UTF-8');
    }
    protected function getTemplating_Helper_FormService()
    {
        return $this->services['templating.helper.form'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper(new \Symfony\Component\Form\FormRenderer(new \Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine($this->get('templating.engine.php'), array(0 => 'FrameworkBundle:Form')), $this->get('form.csrf_provider')));
    }
    protected function getTemplating_Helper_LogoutUrlService()
    {
        $this->services['templating.helper.logout_url'] = $instance = new \Symfony\Bundle\SecurityBundle\Templating\Helper\LogoutUrlHelper($this, $this->get('router'));
        $instance->registerListener('main', '/logout', 'logout', '_csrf_token', NULL);
        return $instance;
    }
    protected function getTemplating_Helper_RequestService()
    {
        return $this->services['templating.helper.request'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper($this->get('request'));
    }
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('router'));
    }
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.context'));
    }
    protected function getTemplating_Helper_SessionService()
    {
        return $this->services['templating.helper.session'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper($this->get('request'));
    }
    protected function getTemplating_Helper_SlotsService()
    {
        return $this->services['templating.helper.slots'] = new \Symfony\Component\Templating\Helper\SlotsHelper();
    }
    protected function getTemplating_Helper_TranslatorService()
    {
        return $this->services['templating.helper.translator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper($this->get('translator.default'));
    }
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();
        $instance->addExtractor('php', $this->get('translation.extractor.php'));
        $instance->addExtractor('twig', $this->get('twig.translation.extractor'));
        return $instance;
    }
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');
        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();
        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        return $instance;
    }
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtTranslationsLoader();
    }
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();
        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));
        return $instance;
    }
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini')), array('cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/translations', 'debug' => false));
        $instance->setFallbackLocale('fr');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.bg.xlf', 'bg', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ca.xlf', 'ca', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cs.xlf', 'cs', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.da.xlf', 'da', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.de.xlf', 'de', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.en.xlf', 'en', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.es.xlf', 'es', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.et.xlf', 'et', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.eu.xlf', 'eu', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fa.xlf', 'fa', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fi.xlf', 'fi', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fr.xlf', 'fr', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.he.xlf', 'he', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hr.xlf', 'hr', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hu.xlf', 'hu', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hy.xlf', 'hy', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.id.xlf', 'id', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.it.xlf', 'it', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ja.xlf', 'ja', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lb.xlf', 'lb', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lt.xlf', 'lt', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.mn.xlf', 'mn', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nb.xlf', 'nb', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nl.xlf', 'nl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pl.xlf', 'pl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt.xlf', 'pt', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt_BR.xlf', 'pt_BR', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ro.xlf', 'ro', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ru.xlf', 'ru', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sk.xlf', 'sk', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sl.xlf', 'sl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Cyrl.xlf', 'sr_Cyrl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Latn.xlf', 'sr_Latn', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sv.xlf', 'sv', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.uk.xlf', 'uk', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_CN.xlf', 'zh_CN', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.bg.xlf', 'bg', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ca.xlf', 'ca', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.cs.xlf', 'cs', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.da.xlf', 'da', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.de.xlf', 'de', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.en.xlf', 'en', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.es.xlf', 'es', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.et.xlf', 'et', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.eu.xlf', 'eu', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fa.xlf', 'fa', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fi.xlf', 'fi', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fr.xlf', 'fr', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.he.xlf', 'he', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hr.xlf', 'hr', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hu.xlf', 'hu', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hy.xlf', 'hy', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.id.xlf', 'id', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.it.xlf', 'it', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ja.xlf', 'ja', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lb.xlf', 'lb', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lt.xlf', 'lt', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.mn.xlf', 'mn', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nb.xlf', 'nb', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nl.xlf', 'nl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pl.xlf', 'pl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt.xlf', 'pt', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt_BR.xlf', 'pt_BR', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ro.xlf', 'ro', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ru.xlf', 'ru', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sk.xlf', 'sk', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sl.xlf', 'sl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Cyrl.xlf', 'sr_Cyrl', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Latn.xlf', 'sr_Latn', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sv.xlf', 'sv', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ua.xlf', 'ua', 'validators');
        $instance->addResource('xlf', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.zh_CN.xlf', 'zh_CN', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ar.yml', 'ar', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.bg.yml', 'bg', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ca.yml', 'ca', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.cs.yml', 'cs', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.da.yml', 'da', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.de.yml', 'de', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.en.yml', 'en', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.es.yml', 'es', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.et.yml', 'et', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fa.yml', 'fa', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fi.yml', 'fi', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fr.yml', 'fr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.hr.yml', 'hr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.hu.yml', 'hu', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.id.yml', 'id', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.it.yml', 'it', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ja.yml', 'ja', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lb.yml', 'lb', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lt.yml', 'lt', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lv.yml', 'lv', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.nb.yml', 'nb', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.nl.yml', 'nl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pl.yml', 'pl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_BR.yml', 'pt_BR', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_PT.yml', 'pt_PT', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ro.yml', 'ro', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ru.yml', 'ru', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sk.yml', 'sk', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sl.yml', 'sl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sr_Latn.yml', 'sr_Latn', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sv.yml', 'sv', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.tr.yml', 'tr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.uk.yml', 'uk', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.zh_CN.yml', 'zh_CN', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ar.yml', 'ar', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.bg.yml', 'bg', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.cs.yml', 'cs', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.da.yml', 'da', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.de.yml', 'de', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.en.yml', 'en', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.es.yml', 'es', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fa.yml', 'fa', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fi.yml', 'fi', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fr.yml', 'fr', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.hr.yml', 'hr', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.hu.yml', 'hu', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.id.yml', 'id', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.it.yml', 'it', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ja.yml', 'ja', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.lt.yml', 'lt', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.lv.yml', 'lv', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.nb.yml', 'nb', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.nl.yml', 'nl', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pl.yml', 'pl', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pt.yml', 'pt', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pt_BR.yml', 'pt_BR', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ro.yml', 'ro', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ru.yml', 'ru', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sk.yml', 'sk', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sl.yml', 'sl', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sr_Latn.yml', 'sr_Latn', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sv.yml', 'sv', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.tr.yml', 'tr', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.uk.yml', 'uk', 'validators');
        $instance->addResource('yml', '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.zh_CN.yml', 'zh_CN', 'validators');
        return $instance;
    }
    protected function getTwigService()
    {
        $a = $this->get('security.context');
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('debug' => false, 'strict_variables' => false, 'exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', 'cache' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/twig', 'charset' => 'UTF-8', 'paths' => array()));
        $instance->addExtension(new \Symfony\Bundle\SecurityBundle\Twig\Extension\LogoutUrlExtension($this->get('templating.helper.logout_url')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension($a));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator.default')));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\AssetsExtension($this));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($this));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\CodeExtension($this));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('router')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer(new \Symfony\Bridge\Twig\Form\TwigRendererEngine(array(0 => 'form_div_layout.html.twig', 1 => 'IvoryCKEditorBundle:Form:ckeditor_widget.html.twig', 2 => 'LiipImagineBundle:Form:form_div_layout.html.twig')), $this->get('form.csrf_provider'))));
        $instance->addExtension(new \Symfony\Bundle\AsseticBundle\Twig\AsseticExtension($this->get('assetic.asset_factory'), $this->get('templating.name_parser'), false, array(), array(0 => 'FMElfinderBundle'), new \Symfony\Bundle\AsseticBundle\DefaultValueSupplier($this)));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension(new \JMS\SecurityExtraBundle\Twig\SecurityExtension($a));
        $instance->addExtension($this->get('knp_paginator.twig.extension.pagination'));
        $instance->addExtension($this->get('twig.extension.fm_tinymce_init'));
        $instance->addExtension(new \Liip\ImagineBundle\Templating\ImagineExtension($this->get('liip_imagine.cache.manager')));
        $instance->addGlobal('app', $this->get('templating.globals'));
        return $instance;
    }
    protected function getTwig_ExceptionListenerService()
    {
        return $this->services['twig.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', $this->get('monolog.logger.request'));
    }
    protected function getTwig_Extension_FmTinymceInitService()
    {
        return $this->services['twig.extension.fm_tinymce_init'] = new \FM\ElfinderBundle\Twig\Extension\FMElfinderTinymceExtension($this);
    }
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));
        $instance->addPath('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form');
        return $instance;
    }
    protected function getTwig_Translation_ExtractorService()
    {
        return $this->services['twig.translation.extractor'] = new \Symfony\Bridge\Twig\Translation\TwigExtractor($this->get('twig'));
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = new \Symfony\Component\Validator\Validator($this->get('validator.mapping.class_metadata_factory'), new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('security.validator.user_password' => 'security.validator.user_password', 'doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique')), array(0 => $this->get('doctrine.orm.validator_initializer'), 1 => new \FOS\UserBundle\Validator\Initializer($this->get('fos_user.user_manager'))));
    }
    protected function getDatabaseConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }
    protected function getDoctrine_Orm_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getFosUser_Util_UsernameCanonicalizerService()
    {
        return $this->get('fos_user.util.email_canonicalizer');
    }
    protected function getSecurity_Acl_Dbal_ConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }
    protected function getSession_StorageService()
    {
        return $this->get('session.storage.native');
    }
    protected function getTranslatorService()
    {
        return $this->get('translator.default');
    }
    protected function getAssetic_AssetFactoryService()
    {
        return $this->services['assetic.asset_factory'] = new \Symfony\Bundle\AsseticBundle\Factory\AssetFactory($this->get('kernel'), $this, $this->getParameterBag(), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web', false);
    }
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }
    protected function getFosUser_EntityManagerService()
    {
        return $this->services['fos_user.entity_manager'] = $this->get('doctrine')->getManager(NULL);
    }
    protected function getFosUser_UserProvider_UsernameService()
    {
        return $this->services['fos_user.user_provider.username'] = new \FOS\UserBundle\Security\UserProvider($this->get('fos_user.user_manager'));
    }
    protected function getJmsDiExtra_ControllerResolverService()
    {
        return $this->services['jms_di_extra.controller_resolver'] = new \JMS\DiExtraBundle\HttpKernel\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request'));
    }
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }
    protected function getSecurity_Access_DecisionManagerService()
    {
        $a = new \JMS\SecurityExtraBundle\Security\Authorization\Expression\LazyLoadingExpressionVoter(new \JMS\SecurityExtraBundle\Security\Authorization\Expression\ContainerAwareExpressionHandler($this));
        $a->setLazyCompiler($this, 'security.expressions.compiler');
        $a->setCacheDir('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_security/expressions');
        return $this->services['security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(0 => $a, 1 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter($this->get('security.role_hierarchy')), 2 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($this->get('security.authentication.trust_resolver')), 3 => new \JMS\SecurityExtraBundle\Security\Acl\Voter\AclVoter($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map'), $this->get('monolog.logger.security'), true)), 'affirmative', false, true);
    }
    protected function getSecurity_Acl_ObjectIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.object_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy();
    }
    protected function getSecurity_Acl_Permission_MapService()
    {
        return $this->services['security.acl.permission.map'] = new \Symfony\Component\Security\Acl\Permission\BasicPermissionMap();
    }
    protected function getSecurity_Acl_SecurityIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.security_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy($this->get('security.role_hierarchy'), $this->get('security.authentication.trust_resolver'));
    }
    protected function getSecurity_Authentication_ManagerService()
    {
        $this->services['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('fos_user.user_provider.username'), $this->get('security.user_checker'), 'main', $this->get('security.encoder_factory'), true), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('51dedf673c196')), true);
        $instance->setEventDispatcher($this->get('event_dispatcher'));
        return $instance;
    }
    protected function getSecurity_Authentication_SessionStrategyService()
    {
        return $this->services['security.authentication.session_strategy'] = new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate');
    }
    protected function getSecurity_Extra_MetadataFactoryService()
    {
        $this->services['security.extra.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'security.extra.metadata_driver'), new \Metadata\Cache\FileCache('/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_security', false));
        $instance->setIncludeInterfaces(true);
        return $instance;
    }
    protected function getSecurity_UserCheckerService()
    {
        return $this->services['security.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }
    protected function getSwiftmailer_Transport_EventdispatcherService()
    {
        return $this->services['swiftmailer.transport.eventdispatcher'] = new \Swift_Events_SimpleEventDispatcher();
    }
    protected function getTemplating_Engine_PhpService()
    {
        $this->services['templating.engine.php'] = $instance = new \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine($this->get('templating.name_parser'), $this, $this->get('templating.loader'), $this->get('templating.globals'));
        $instance->setCharset('UTF-8');
        $instance->setHelpers(array('slots' => 'templating.helper.slots', 'assets' => 'templating.helper.assets', 'request' => 'templating.helper.request', 'session' => 'templating.helper.session', 'router' => 'templating.helper.router', 'actions' => 'templating.helper.actions', 'code' => 'templating.helper.code', 'translator' => 'templating.helper.translator', 'form' => 'templating.helper.form', 'logout_url' => 'templating.helper.logout_url', 'security' => 'templating.helper.security', 'assetic' => 'assetic.helper.static', 'knp_pagination' => 'knp_paginator.templating.helper.pagination', 'imagine' => 'liip_imagine.templating.helper'));
        return $instance;
    }
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod');
    }
    protected function getValidator_Mapping_ClassMetadataFactoryService()
    {
        return $this->services['validator.mapping.class_metadata_factory'] = new \Symfony\Component\Validator\Mapping\ClassMetadataFactory(new \Symfony\Component\Validator\Mapping\Loader\LoaderChain(array(0 => new \Symfony\Component\Validator\Mapping\Loader\AnnotationLoader($this->get('annotation_reader')), 1 => new \Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader(), 2 => new \Symfony\Component\Validator\Mapping\Loader\XmlFilesLoader(array(0 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml', 1 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/validation.xml', 2 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/validation/orm.xml')), 3 => new \Symfony\Component\Validator\Mapping\Loader\YamlFilesLoader(array()))), NULL);
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!array_key_exists($name, $this->parameters)) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app',
            'kernel.environment' => 'prod',
            'kernel.debug' => false,
            'kernel.name' => 'ap_',
            'kernel.cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod',
            'kernel.logs_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/logs',
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'SwiftmailerBundle' => 'Symfony\\Bundle\\SwiftmailerBundle\\SwiftmailerBundle',
                'AsseticBundle' => 'Symfony\\Bundle\\AsseticBundle\\AsseticBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'JMSAopBundle' => 'JMS\\AopBundle\\JMSAopBundle',
                'JMSDiExtraBundle' => 'JMS\\DiExtraBundle\\JMSDiExtraBundle',
                'JMSSecurityExtraBundle' => 'JMS\\SecurityExtraBundle\\JMSSecurityExtraBundle',
                'BackOfficeBundle' => 'ArrasFilmFestival\\BackOfficeBundle\\BackOfficeBundle',
                'FrontOfficeBundle' => 'ArrasFilmFestival\\FrontOfficeBundle\\FrontOfficeBundle',
                'IvoryCKEditorBundle' => 'Ivory\\CKEditorBundle\\IvoryCKEditorBundle',
                'FOSUserBundle' => 'FOS\\UserBundle\\FOSUserBundle',
                'KnpPaginatorBundle' => 'Knp\\Bundle\\PaginatorBundle\\KnpPaginatorBundle',
                'FMElfinderBundle' => 'FM\\ElfinderBundle\\FMElfinderBundle',
                'LiipImagineBundle' => 'Liip\\ImagineBundle\\LiipImagineBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appProdProjectContainer',
            'database_driver' => 'pdo_mysql',
            'database_host' => '127.0.0.1',
            'database_port' => NULL,
            'database_name' => 'ArrasFilmFestival',
            'database_user' => 'root',
            'database_password' => NULL,
            'mailer_transport' => 'smtp',
            'mailer_host' => '127.0.0.1',
            'mailer_user' => NULL,
            'mailer_password' => NULL,
            'locale' => 'fr',
            'secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Bundle\\FrameworkBundle\\HttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtTranslationsLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'kernel.secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'kernel.trusted_proxies' => array(
            ),
            'kernel.trust_proxy_headers' => false,
            'kernel.default_locale' => 'fr',
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
            'session.flashbag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            'session.attribute_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Attribute\\AttributeBag',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\NativeSessionStorage',
            'session.storage.mock_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MockFileSessionStorage',
            'session.handler.native_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\NativeFileSessionHandler',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.storage.options' => array(
            ),
            'session.save_path' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/sessions',
            'form.resolved_type_factory.class' => 'Symfony\\Component\\Form\\ResolvedFormTypeFactory',
            'form.registry.class' => 'Symfony\\Component\\Form\\FormRegistry',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'form.csrf_provider.class' => 'Symfony\\Component\\Form\\Extension\\Csrf\\CsrfProvider\\SessionCsrfProvider',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'validator.class' => 'Symfony\\Component\\Validator\\Validator',
            'validator.mapping.class_metadata_factory.class' => 'Symfony\\Component\\Validator\\Mapping\\ClassMetadataFactory',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.mapping.loader.loader_chain.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\LoaderChain',
            'validator.mapping.loader.static_method_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\StaticMethodLoader',
            'validator.mapping.loader.annotation_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\AnnotationLoader',
            'validator.mapping.loader.xml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\XmlFilesLoader',
            'validator.mapping.loader.yaml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\YamlFilesLoader',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.mapping.loader.xml_files_loader.mapping_files' => array(
                0 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml',
                1 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/validation.xml',
                2 => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/validation/orm.xml',
            ),
            'validator.mapping.loader.yaml_files_loader.mapping_files' => array(
            ),
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'appProdUrlMatcher',
            'router.options.generator.cache_class' => 'appProdUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.resource' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/config/routing.yml',
            'router.cache_class_prefix' => 'appProd',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.filename_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateFilenameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.engine.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\PhpEngine',
            'templating.helper.slots.class' => 'Symfony\\Component\\Templating\\Helper\\SlotsHelper',
            'templating.helper.assets.class' => 'Symfony\\Component\\Templating\\Helper\\CoreAssetsHelper',
            'templating.helper.actions.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\ActionsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.request.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RequestHelper',
            'templating.helper.session.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\SessionHelper',
            'templating.helper.code.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\CodeHelper',
            'templating.helper.translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\TranslatorHelper',
            'templating.helper.form.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\FormHelper',
            'templating.form.engine.class' => 'Symfony\\Component\\Form\\Extension\\Templating\\TemplatingRendererEngine',
            'templating.form.renderer.class' => 'Symfony\\Component\\Form\\FormRenderer',
            'templating.globals.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\GlobalVariables',
            'templating.asset.path_package.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PathPackage',
            'templating.asset.url_package.class' => 'Symfony\\Component\\Templating\\Asset\\UrlPackage',
            'templating.asset.package_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PackageFactory',
            'templating.helper.code.file_link_format' => NULL,
            'templating.helper.form.resources' => array(
                0 => 'FrameworkBundle:Form',
            ),
            'templating.hinclude.default_template' => NULL,
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
            ),
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'security.context.class' => 'Symfony\\Component\\Security\\Core\\SecurityContext',
            'security.user_checker.class' => 'Symfony\\Component\\Security\\Core\\User\\UserChecker',
            'security.encoder_factory.generic.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\EncoderFactory',
            'security.encoder.digest.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder',
            'security.encoder.plain.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder',
            'security.user.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\User\\InMemoryUserProvider',
            'security.user.provider.in_memory.user.class' => 'Symfony\\Component\\Security\\Core\\User\\User',
            'security.user.provider.chain.class' => 'Symfony\\Component\\Security\\Core\\User\\ChainUserProvider',
            'security.authentication.trust_resolver.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolver',
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.authentication.manager.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationProviderManager',
            'security.authentication.session_strategy.class' => 'Symfony\\Component\\Security\\Http\\Session\\SessionAuthenticationStrategy',
            'security.access.decision_manager.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\AccessDecisionManager',
            'security.access.simple_role_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleVoter',
            'security.access.authenticated_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter',
            'security.access.role_hierarchy_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleHierarchyVoter',
            'security.firewall.class' => 'Symfony\\Component\\Security\\Http\\Firewall',
            'security.firewall.map.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallMap',
            'security.firewall.context.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallContext',
            'security.matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'security.role_hierarchy.class' => 'Symfony\\Component\\Security\\Core\\Role\\RoleHierarchy',
            'security.http_utils.class' => 'Symfony\\Component\\Security\\Http\\HttpUtils',
            'security.validator.user_password.class' => 'Symfony\\Component\\Security\\Core\\Validator\\Constraint\\UserPasswordValidator',
            'security.authentication.retry_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\RetryAuthenticationEntryPoint',
            'security.channel_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ChannelListener',
            'security.authentication.form_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\FormAuthenticationEntryPoint',
            'security.authentication.listener.form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\UsernamePasswordFormAuthenticationListener',
            'security.authentication.listener.basic.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\BasicAuthenticationListener',
            'security.authentication.basic_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\BasicAuthenticationEntryPoint',
            'security.authentication.listener.digest.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\DigestAuthenticationListener',
            'security.authentication.digest_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\DigestAuthenticationEntryPoint',
            'security.authentication.listener.x509.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\X509AuthenticationListener',
            'security.authentication.listener.anonymous.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AnonymousAuthenticationListener',
            'security.authentication.switchuser_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SwitchUserListener',
            'security.logout_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\LogoutListener',
            'security.logout.handler.session.class' => 'Symfony\\Component\\Security\\Http\\Logout\\SessionLogoutHandler',
            'security.logout.handler.cookie_clearing.class' => 'Symfony\\Component\\Security\\Http\\Logout\\CookieClearingLogoutHandler',
            'security.logout.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Logout\\DefaultLogoutSuccessHandler',
            'security.access_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AccessListener',
            'security.access_map.class' => 'Symfony\\Component\\Security\\Http\\AccessMap',
            'security.exception_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ExceptionListener',
            'security.context_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ContextListener',
            'security.authentication.provider.dao.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\DaoAuthenticationProvider',
            'security.authentication.provider.pre_authenticated.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\PreAuthenticatedAuthenticationProvider',
            'security.authentication.provider.anonymous.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\AnonymousAuthenticationProvider',
            'security.authentication.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationSuccessHandler',
            'security.authentication.failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationFailureHandler',
            'security.authentication.provider.rememberme.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\RememberMeAuthenticationProvider',
            'security.authentication.listener.rememberme.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\RememberMeListener',
            'security.rememberme.token.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\RememberMe\\InMemoryTokenProvider',
            'security.authentication.rememberme.services.persistent.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\PersistentTokenBasedRememberMeServices',
            'security.authentication.rememberme.services.simplehash.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\TokenBasedRememberMeServices',
            'security.rememberme.response_listener.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener',
            'templating.helper.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\LogoutUrlHelper',
            'templating.helper.security.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\SecurityHelper',
            'twig.extension.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Twig\\Extension\\LogoutUrlExtension',
            'twig.extension.security.class' => 'Symfony\\Bridge\\Twig\\Extension\\SecurityExtension',
            'data_collector.security.class' => 'Symfony\\Bundle\\SecurityBundle\\DataCollector\\SecurityDataCollector',
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'security.role_hierarchy.roles' => array(
                'ROLE_BAUDIMONT' => array(
                    0 => 'ROLE_USER',
                ),
                'ROLE_POLECOM' => array(
                    0 => 'ROLE_USER',
                ),
                'ROLE_SUPER_ADMIN' => array(
                    0 => 'ROLE_ADMIN',
                    1 => 'ROLE_POLECOM',
                ),
            ),
            'security.acl.permission_granting_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\PermissionGrantingStrategy',
            'security.acl.voter.class' => 'Symfony\\Component\\Security\\Acl\\Voter\\AclVoter',
            'security.acl.permission.map.class' => 'Symfony\\Component\\Security\\Acl\\Permission\\BasicPermissionMap',
            'security.acl.object_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\ObjectIdentityRetrievalStrategy',
            'security.acl.security_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\SecurityIdentityRetrievalStrategy',
            'security.acl.cache.doctrine.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\DoctrineAclCache',
            'security.acl.collection_cache.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\AclCollectionCache',
            'security.acl.dbal.provider.class' => 'Symfony\\Component\\Security\\Acl\\Dbal\\MutableAclProvider',
            'security.acl.dbal.schema.class' => 'Symfony\\Component\\Security\\Acl\\Dbal\\Schema',
            'security.acl.dbal.schema_listener.class' => 'Symfony\\Bundle\\SecurityBundle\\EventListener\\AclSchemaListener',
            'security.acl.dbal.class_table_name' => 'acl_classes',
            'security.acl.dbal.entry_table_name' => 'acl_entries',
            'security.acl.dbal.oid_table_name' => 'acl_object_identities',
            'security.acl.dbal.oid_ancestors_table_name' => 'acl_object_identity_ancestors',
            'security.acl.dbal.sid_table_name' => 'acl_security_identities',
            'twig.class' => 'Twig_Environment',
            'twig.loader.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.assets.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\AssetsExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.form.engine.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRendererEngine',
            'twig.form.renderer.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRenderer',
            'twig.translation.extractor.class' => 'Symfony\\Bridge\\Twig\\Translation\\TwigExtractor',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.exception_listener.controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
                1 => 'IvoryCKEditorBundle:Form:ckeditor_widget.html.twig',
                2 => 'LiipImagineBundle:Form:form_div_layout.html.twig',
            ),
            'twig.options' => array(
                'debug' => false,
                'strict_variables' => false,
                'exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction',
                'cache' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/twig',
                'charset' => 'UTF-8',
                'paths' => array(
                ),
            ),
            'monolog.logger.class' => 'Symfony\\Bridge\\Monolog\\Logger',
            'monolog.gelf.publisher.class' => 'Gelf\\MessagePublisher',
            'monolog.handler.stream.class' => 'Monolog\\Handler\\StreamHandler',
            'monolog.handler.group.class' => 'Monolog\\Handler\\GroupHandler',
            'monolog.handler.buffer.class' => 'Monolog\\Handler\\BufferHandler',
            'monolog.handler.rotating_file.class' => 'Monolog\\Handler\\RotatingFileHandler',
            'monolog.handler.syslog.class' => 'Monolog\\Handler\\SyslogHandler',
            'monolog.handler.null.class' => 'Monolog\\Handler\\NullHandler',
            'monolog.handler.test.class' => 'Monolog\\Handler\\TestHandler',
            'monolog.handler.gelf.class' => 'Monolog\\Handler\\GelfHandler',
            'monolog.handler.firephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\FirePHPHandler',
            'monolog.handler.chromephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ChromePhpHandler',
            'monolog.handler.debug.class' => 'Symfony\\Bridge\\Monolog\\Handler\\DebugHandler',
            'monolog.handler.swift_mailer.class' => 'Monolog\\Handler\\SwiftMailerHandler',
            'monolog.handler.native_mailer.class' => 'Monolog\\Handler\\NativeMailerHandler',
            'monolog.handler.socket.class' => 'Monolog\\Handler\\SocketHandler',
            'monolog.handler.fingers_crossed.class' => 'Monolog\\Handler\\FingersCrossedHandler',
            'monolog.handler.fingers_crossed.error_level_activation_strategy.class' => 'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy',
            'monolog.handlers_to_channels' => array(
                'monolog.handler.main' => NULL,
            ),
            'swiftmailer.class' => 'Swift_Mailer',
            'swiftmailer.transport.sendmail.class' => 'Swift_Transport_SendmailTransport',
            'swiftmailer.transport.mail.class' => 'Swift_Transport_MailTransport',
            'swiftmailer.transport.failover.class' => 'Swift_Transport_FailoverTransport',
            'swiftmailer.plugin.redirecting.class' => 'Swift_Plugins_RedirectingPlugin',
            'swiftmailer.plugin.impersonate.class' => 'Swift_Plugins_ImpersonatePlugin',
            'swiftmailer.plugin.messagelogger.class' => 'Swift_Plugins_MessageLogger',
            'swiftmailer.plugin.antiflood.class' => 'Swift_Plugins_AntiFloodPlugin',
            'swiftmailer.plugin.antiflood.threshold' => 99,
            'swiftmailer.plugin.antiflood.sleep' => 0,
            'swiftmailer.data_collector.class' => 'Symfony\\Bridge\\Swiftmailer\\DataCollector\\MessageDataCollector',
            'swiftmailer.transport.smtp.class' => 'Swift_Transport_EsmtpTransport',
            'swiftmailer.transport.smtp.encryption' => NULL,
            'swiftmailer.transport.smtp.port' => 25,
            'swiftmailer.transport.smtp.host' => '127.0.0.1',
            'swiftmailer.transport.smtp.username' => NULL,
            'swiftmailer.transport.smtp.password' => NULL,
            'swiftmailer.transport.smtp.auth_mode' => NULL,
            'swiftmailer.transport.smtp.timeout' => 30,
            'swiftmailer.transport.smtp.source_ip' => NULL,
            'swiftmailer.plugin.blackhole.class' => 'Swift_Plugins_BlackholePlugin',
            'swiftmailer.spool.memory.class' => 'Swift_MemorySpool',
            'swiftmailer.email_sender.listener.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener',
            'swiftmailer.spool.memory.path' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/swiftmailer/spool',
            'swiftmailer.spool.enabled' => true,
            'swiftmailer.sender_address' => NULL,
            'swiftmailer.single_address' => NULL,
            'swiftmailer.delivery_whitelist' => array(
            ),
            'assetic.asset_factory.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\AssetFactory',
            'assetic.asset_manager.class' => 'Assetic\\Factory\\LazyAssetManager',
            'assetic.asset_manager_cache_warmer.class' => 'Symfony\\Bundle\\AsseticBundle\\CacheWarmer\\AssetManagerCacheWarmer',
            'assetic.cached_formula_loader.class' => 'Assetic\\Factory\\Loader\\CachedFormulaLoader',
            'assetic.config_cache.class' => 'Assetic\\Cache\\ConfigCache',
            'assetic.config_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\ConfigurationLoader',
            'assetic.config_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\ConfigurationResource',
            'assetic.coalescing_directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\CoalescingDirectoryResource',
            'assetic.directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\DirectoryResource',
            'assetic.filter_manager.class' => 'Symfony\\Bundle\\AsseticBundle\\FilterManager',
            'assetic.worker.ensure_filter.class' => 'Assetic\\Factory\\Worker\\EnsureFilterWorker',
            'assetic.value_supplier.class' => 'Symfony\\Bundle\\AsseticBundle\\DefaultValueSupplier',
            'assetic.node.paths' => array(
            ),
            'assetic.cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/assetic',
            'assetic.bundles' => array(
                0 => 'FMElfinderBundle',
            ),
            'assetic.twig_extension.class' => 'Symfony\\Bundle\\AsseticBundle\\Twig\\AsseticExtension',
            'assetic.twig_formula_loader.class' => 'Assetic\\Extension\\Twig\\TwigFormulaLoader',
            'assetic.helper.dynamic.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\DynamicAsseticHelper',
            'assetic.helper.static.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\StaticAsseticHelper',
            'assetic.php_formula_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\AsseticHelperFormulaLoader',
            'assetic.debug' => false,
            'assetic.use_controller' => false,
            'assetic.enable_profiler' => false,
            'assetic.read_from' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web',
            'assetic.write_to' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web',
            'assetic.variables' => array(
            ),
            'assetic.java.bin' => '/usr/bin/java',
            'assetic.node.bin' => '/usr/bin/node',
            'assetic.ruby.bin' => '/Users/thomasleduc/.rbenv/shims/ruby',
            'assetic.sass.bin' => '/usr/bin/sass',
            'assetic.filter.cssrewrite.class' => 'Assetic\\Filter\\CssRewriteFilter',
            'assetic.filter.yui_css.class' => 'Assetic\\Filter\\Yui\\CssCompressorFilter',
            'assetic.filter.yui_css.java' => '/usr/bin/java',
            'assetic.filter.yui_css.jar' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/java/yuicompressor-2.4.7.jar',
            'assetic.filter.yui_css.charset' => 'UTF-8',
            'assetic.filter.yui_css.stacksize' => NULL,
            'assetic.filter.yui_css.timeout' => NULL,
            'assetic.filter.yui_js.class' => 'Assetic\\Filter\\Yui\\JsCompressorFilter',
            'assetic.filter.yui_js.java' => '/usr/bin/java',
            'assetic.filter.yui_js.jar' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/Resources/java/yuicompressor-2.4.7.jar',
            'assetic.filter.yui_js.charset' => 'UTF-8',
            'assetic.filter.yui_js.stacksize' => NULL,
            'assetic.filter.yui_js.timeout' => NULL,
            'assetic.filter.yui_js.nomunge' => NULL,
            'assetic.filter.yui_js.preserve_semi' => NULL,
            'assetic.filter.yui_js.disable_optimizations' => NULL,
            'assetic.twig_extension.functions' => array(
            ),
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(
            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/doctrine/orm/Proxies',
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'sensio_framework_extra.view.guesser.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Templating\\TemplateGuesser',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.converter.datetime.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DateTimeParamConverter',
            'sensio_framework_extra.view.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\TemplateListener',
            'jms_aop.cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_aop',
            'jms_aop.interceptor_loader.class' => 'JMS\\AopBundle\\Aop\\InterceptorLoader',
            'jms_di_extra.metadata.driver.annotation_driver.class' => 'JMS\\DiExtraBundle\\Metadata\\Driver\\AnnotationDriver',
            'jms_di_extra.metadata.driver.configured_controller_injections.class' => 'JMS\\DiExtraBundle\\Metadata\\Driver\\ConfiguredControllerInjectionsDriver',
            'jms_di_extra.metadata.driver.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_di_extra.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_di_extra.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_di_extra.metadata.converter.class' => 'JMS\\DiExtraBundle\\Metadata\\MetadataConverter',
            'jms_di_extra.controller_resolver.class' => 'JMS\\DiExtraBundle\\HttpKernel\\ControllerResolver',
            'jms_di_extra.controller_injectors_warmer.class' => 'JMS\\DiExtraBundle\\HttpKernel\\ControllerInjectorsWarmer',
            'jms_di_extra.all_bundles' => false,
            'jms_di_extra.bundles' => array(
            ),
            'jms_di_extra.directories' => array(
            ),
            'jms_di_extra.cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_diextra',
            'jms_di_extra.doctrine_integration' => true,
            'jms_di_extra.doctrine_integration.entity_manager.file' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_diextra/doctrine/EntityManager_51dedf6753d41.php',
            'jms_di_extra.doctrine_integration.entity_manager.class' => 'EntityManager51dedf6753d41_546a8d27f194334ee012bfe64f629947b07e4919\\__CG__\\Doctrine\\ORM\\EntityManager',
            'security.secured_services' => array(
            ),
            'security.access.method_interceptor.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Interception\\MethodSecurityInterceptor',
            'security.access.method_access_control' => array(
            ),
            'security.access.run_as_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\RunAsManager',
            'security.authentication.provider.run_as.class' => 'JMS\\SecurityExtraBundle\\Security\\Authentication\\Provider\\RunAsAuthenticationProvider',
            'security.run_as.key' => 'RunAsToken',
            'security.run_as.role_prefix' => 'ROLE_',
            'security.access.after_invocation_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AfterInvocationManager',
            'security.access.after_invocation.acl_provider.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AclAfterInvocationProvider',
            'security.access.iddqd_voter.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Voter\\IddqdVoter',
            'security.extra.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'security.extra.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'security.extra.driver_chain.class' => 'Metadata\\Driver\\DriverChain',
            'security.extra.annotation_driver.class' => 'JMS\\SecurityExtraBundle\\Metadata\\Driver\\AnnotationDriver',
            'security.extra.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'security.access.secure_all_services' => false,
            'security.extra.cache_dir' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/cache/prod/jms_security',
            'security.acl.permission_evaluator.class' => 'JMS\\SecurityExtraBundle\\Security\\Acl\\Expression\\PermissionEvaluator',
            'security.acl.has_permission_compiler.class' => 'JMS\\SecurityExtraBundle\\Security\\Acl\\Expression\\HasPermissionFunctionCompiler',
            'security.expressions.voter.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\LazyLoadingExpressionVoter',
            'security.expressions.handler.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\ContainerAwareExpressionHandler',
            'security.expressions.compiler.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\ExpressionCompiler',
            'security.expressions.expression.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\Expression',
            'security.expressions.variable_compiler.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\Compiler\\ContainerAwareVariableCompiler',
            'security.expressions.parameter_compiler.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Expression\\Compiler\\ParameterExpressionCompiler',
            'security.extra.config_driver.class' => 'JMS\\SecurityExtraBundle\\Metadata\\Driver\\ConfigDriver',
            'security.extra.twig_extension.class' => 'JMS\\SecurityExtraBundle\\Twig\\SecurityExtension',
            'security.authenticated_voter.disabled' => false,
            'security.role_voter.disabled' => false,
            'security.acl_voter.disabled' => false,
            'ivory_ck_editor.helper.assets_version_trimer.class' => 'Ivory\\CKEditorBundle\\Helper\\AssetsVersionTrimerHelper',
            'ivory_ck_editor.form.type.class' => 'Ivory\\CKEditorBundle\\Form\\Type\\CKEditorType',
            'ivory_ck_editor.config_manager.class' => 'Ivory\\CKEditorBundle\\Model\\ConfigManager',
            'ivory_ck_editor.plugin_manager.class' => 'Ivory\\CKEditorBundle\\Model\\PluginManager',
            'ivory_ck_editor.form.type.enable' => true,
            'ivory_ck_editor.form.type.base_path' => 'bundles/ivoryckeditor/',
            'ivory_ck_editor.form.type.js_path' => 'bundles/ivoryckeditor/ckeditor.js',
            'fos_user.backend_type_orm' => true,
            'fos_user.validator.password.class' => 'FOS\\UserBundle\\Validator\\PasswordValidator',
            'fos_user.validator.unique.class' => 'FOS\\UserBundle\\Validator\\UniqueValidator',
            'fos_user.security.interactive_login_listener.class' => 'FOS\\UserBundle\\EventListener\\LastLoginListener',
            'fos_user.security.login_manager.class' => 'FOS\\UserBundle\\Security\\LoginManager',
            'fos_user.resetting.email.template' => 'FOSUserBundle:Resetting:email.txt.twig',
            'fos_user.registration.confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig',
            'fos_user.storage' => 'orm',
            'fos_user.firewall_name' => 'main',
            'fos_user.model_manager_name' => NULL,
            'fos_user.model.user.class' => 'ArrasFilmFestival\\BackOfficeBundle\\Entity\\User',
            'fos_user.template.engine' => 'twig',
            'fos_user.profile.form.type' => 'fos_user_profile',
            'fos_user.profile.form.name' => 'fos_user_profile_form',
            'fos_user.profile.form.validation_groups' => array(
                0 => 'Profile',
                1 => 'Default',
            ),
            'fos_user.registration.confirmation.from_email' => array(
                'webmaster@example.com' => 'webmaster',
            ),
            'fos_user.registration.confirmation.enabled' => false,
            'fos_user.registration.form.type' => 'fos_user_registration',
            'fos_user.registration.form.name' => 'fos_user_registration_form',
            'fos_user.registration.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'fos_user.change_password.form.type' => 'fos_user_change_password',
            'fos_user.change_password.form.name' => 'fos_user_change_password_form',
            'fos_user.change_password.form.validation_groups' => array(
                0 => 'ChangePassword',
                1 => 'Default',
            ),
            'fos_user.resetting.email.from_email' => array(
                'webmaster@example.com' => 'webmaster',
            ),
            'fos_user.resetting.token_ttl' => 86400,
            'fos_user.resetting.form.type' => 'fos_user_resetting',
            'fos_user.resetting.form.name' => 'fos_user_resetting_form',
            'fos_user.resetting.form.validation_groups' => array(
                0 => 'ResetPassword',
                1 => 'Default',
            ),
            'fos_user.group_manager.class' => 'FOS\\UserBundle\\Doctrine\\GroupManager',
            'fos_user.model.group.class' => 'ArrasFilmFestival\\BackOfficeBundle\\Entity\\Group',
            'fos_user.group.form.type' => 'fos_user_group',
            'fos_user.group.form.name' => 'fos_user_group_form',
            'fos_user.group.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'knp_paginator.class' => 'Knp\\Component\\Pager\\Paginator',
            'knp_paginator.templating.helper.pagination.class' => 'Knp\\Bundle\\PaginatorBundle\\Templating\\PaginationHelper',
            'knp_paginator.helper.processor.class' => 'Knp\\Bundle\\PaginatorBundle\\Helper\\Processor',
            'knp_paginator.template.pagination' => 'KnpPaginatorBundle:Pagination:sliding.html.twig',
            'knp_paginator.template.filtration' => 'KnpPaginatorBundle:Pagination:filtration.html.twig',
            'knp_paginator.template.sortable' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig',
            'knp_paginator.page_range' => 5,
            'elfinder.loader' => 'FM\\ElfinderBundle\\Loader\\FMElfinderLoader',
            'fm_elfinder' => array(
                'locale' => 'fr',
                'showhidden' => false,
                'editor' => 'ckeditor',
                'fullscreen' => true,
                'connector' => array(
                    'debug' => true,
                    'roots' => array(
                        'uploads' => array(
                            'driver' => 'LocalFileSystem',
                            'path' => 'uploads/articles',
                            'upload_allow' => array(
                                0 => 'image/png',
                                1 => 'image/jpg',
                                2 => 'image/jpeg',
                            ),
                            'upload_deny' => array(
                                0 => 'all',
                            ),
                            'upload_max_size' => '2M',
                        ),
                    ),
                ),
                'tinymce_popup_path' => '',
            ),
            'liip_imagine.filter.configuration.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\FilterConfiguration',
            'liip_imagine.filter.manager.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\FilterManager',
            'liip_imagine.data.manager.class' => 'Liip\\ImagineBundle\\Imagine\\Data\\DataManager',
            'liip_imagine.cache.manager.class' => 'Liip\\ImagineBundle\\Imagine\\Cache\\CacheManager',
            'liip_imagine.controller.class' => 'Liip\\ImagineBundle\\Controller\\ImagineController',
            'liip_imagine.routing.loader.class' => 'Liip\\ImagineBundle\\Routing\\ImagineLoader',
            'liip_imagine.twig.extension.class' => 'Liip\\ImagineBundle\\Templating\\ImagineExtension',
            'liip_imagine.templating.helper.class' => 'Liip\\ImagineBundle\\Templating\\Helper\\ImagineHelper',
            'liip_imagine.gd.class' => 'Imagine\\Gd\\Imagine',
            'liip_imagine.imagick.class' => 'Imagine\\Imagick\\Imagine',
            'liip_imagine.gmagick.class' => 'Imagine\\Gmagick\\Imagine',
            'liip_imagine.filter.loader.relative_resize.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\RelativeResizeFilterLoader',
            'liip_imagine.filter.loader.resize.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\ResizeFilterLoader',
            'liip_imagine.filter.loader.thumbnail.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\ThumbnailFilterLoader',
            'liip_imagine.filter.loader.crop.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\CropFilterLoader',
            'liip_imagine.filter.loader.paste.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\PasteFilterLoader',
            'liip_imagine.filter.loader.strip.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\StripFilterLoader',
            'liip_imagine.filter.loader.background.class' => 'Liip\\ImagineBundle\\Imagine\\Filter\\Loader\\BackgroundFilterLoader',
            'liip_imagine.data.loader.filesystem.class' => 'Liip\\ImagineBundle\\Imagine\\Data\\Loader\\FileSystemLoader',
            'liip_imagine.data.loader.stream.class' => 'Liip\\ImagineBundle\\Imagine\\Data\\Loader\\StreamLoader',
            'liip_imagine.cache.resolver.web_path.class' => 'Liip\\ImagineBundle\\Imagine\\Cache\\Resolver\\WebPathResolver',
            'liip_imagine.cache.resolver.no_cache.class' => 'Liip\\ImagineBundle\\Imagine\\Cache\\Resolver\\NoCacheResolver',
            'liip_imagine.form.type.image.class' => 'Liip\\ImagineBundle\\Form\\Type\\ImageType',
            'liip_imagine.cache.clearer.class' => 'Liip\\ImagineBundle\\Imagine\\Cache\\CacheClearer',
            'liip_imagine.cache_prefix' => '/media/cache',
            'liip_imagine.web_root' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web',
            'liip_imagine.data_root' => '/Users/thomasleduc/Documents/Projets/Symfony/Arras Film Festival/app/../web',
            'liip_imagine.cache_mkdir_mode' => 511,
            'liip_imagine.formats' => array(
            ),
            'liip_imagine.cache.resolver.default' => 'web_path',
            'liip_imagine.filter_sets' => array(
                'back_thumb' => array(
                    'filters' => array(
                        'thumbnail' => array(
                            'size' => array(
                                0 => 290,
                                1 => 200,
                            ),
                            'mode' => 'outbound',
                        ),
                    ),
                    'quality' => 100,
                    'format' => NULL,
                    'cache' => NULL,
                    'data_loader' => NULL,
                    'controller_action' => NULL,
                    'route' => array(
                    ),
                ),
                'front_thumb' => array(
                    'filters' => array(
                        'thumbnail' => array(
                            'size' => array(
                                0 => 280,
                                1 => 180,
                            ),
                            'mode' => 'outbound',
                        ),
                    ),
                    'quality' => 100,
                    'format' => NULL,
                    'cache' => NULL,
                    'data_loader' => NULL,
                    'controller_action' => NULL,
                    'route' => array(
                    ),
                ),
                'front_widen' => array(
                    'filters' => array(
                        'relative_resize' => array(
                            'widen' => 500,
                        ),
                    ),
                    'quality' => 100,
                    'format' => NULL,
                    'cache' => NULL,
                    'data_loader' => NULL,
                    'controller_action' => NULL,
                    'route' => array(
                    ),
                ),
            ),
            'liip_imagine.data.loader.default' => 'filesystem',
            'liip_imagine.controller_action' => 'liip_imagine.controller:filterAction',
            'liip_imagine.cache.resolver.base_path' => '',
        );
    }
}
