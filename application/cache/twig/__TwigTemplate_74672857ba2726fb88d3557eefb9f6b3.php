<?php

/* layout/default/main.html */
class __TwigTemplate_74672857ba2726fb88d3557eefb9f6b3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'script' => array($this, 'block_script'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    public function display(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"it\" lang=\"it\">
\t<head>
\t\t<title>";
        // line 4
        $this->getBlock('title', $context, $blocks);
        echo "</title>
\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/> 
\t\t";
        // line 6
        $this->getBlock('css', $context, $blocks);
        // line 8
        echo "
\t\t";
        // line 9
        $this->getBlock('script', $context, $blocks);
        echo "
\t</head>
\t<body>
\t\t<div id=\"container\">
\t\t\t<div id=\"header\">";
        // line 13
        $this->getBlock('header', $context, $blocks);
        echo "</div>
\t\t\t<div id=\"content\">";
        // line 14
        $this->getBlock('content', $context, $blocks);
        echo "</div>
\t\t\t<div id=\"footer\">";
        // line 15
        $this->getBlock('footer', $context, $blocks);
        echo "</div>
\t\t</div>
\t</body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 6
    public function block_css($context, array $blocks = array())
    {
        echo "
\t\t\t<link href=\"";
        // line 7
        echo $this->getContext($context, 'WebRoot');
        echo "/style/";
        echo $this->getContext($context, 'ThemeName');
        echo "/base.css\" rel=\"stylesheet\" type=\"text/css\" />
\t\t";
    }

    // line 9
    public function block_script($context, array $blocks = array())
    {
    }

    // line 13
    public function block_header($context, array $blocks = array())
    {
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
    }

    // line 15
    public function block_footer($context, array $blocks = array())
    {
    }

}
