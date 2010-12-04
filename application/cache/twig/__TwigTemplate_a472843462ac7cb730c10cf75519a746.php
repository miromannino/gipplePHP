<?php

/* home.html */
class __TwigTemplate_a472843462ac7cb730c10cf75519a746 extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'script' => array($this, 'block_script'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = (("layout/" . $this->getContext($context, 'ThemeName')) . "/main.html");
            if (!$this->parent instanceof Twig_Template) {
                $this->parent = $this->env->loadTemplate($this->parent);
            }
        }

        return $this->parent;
    }

    public function display(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_css($context, array $blocks = array())
    {
        echo "
\t\t\t";
        // line 4
        $this->getParentBlock("css", $context, $blocks);
        echo "
\t\t\t<link href=\"";
        // line 5
        echo $this->getContext($context, 'WebRoot');
        echo "/style/css/home.css\" rel=\"stylesheet\" type=\"text/css\" />
";
    }

    // line 8
    public function block_script($context, array $blocks = array())
    {
        echo "
\t\t";
        // line 9
        $this->getParentBlock("script", $context, $blocks);
        echo "
";
    }

    // line 12
    public function block_header($context, array $blocks = array())
    {
        echo "
\t\t\theader
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        echo "
\t\t\t<h2>contenuto</h2>
";
    }

    // line 20
    public function block_footer($context, array $blocks = array())
    {
        echo "
\t\t\tfooter
";
    }

}
