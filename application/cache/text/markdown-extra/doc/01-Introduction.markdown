<h1>Introduction</h1>

<p>This is the documentation for Twig, the flexible, fast, and secure template
language for PHP.</p>

<p>If you have any exposure to other text-based template languages, such as
Smarty, Django, or Jinja, you should feel right at home with Twig. It's both
designer and developer friendly by sticking to PHP's principles and adding
functionality useful for templating environments.</p>

<p>The key-features are...</p>

<ul>
<li><p><em>Fast</em>: Twig compiles templates down to plain optimized PHP code. The
overhead compared to regular PHP code was reduced to the very minimum.</p></li>
<li><p><em>Secure</em>: Twig has a sandbox mode to evaluate untrusted template code. This
allows Twig to be used as a templating language for applications where
users may modify the template design.</p></li>
<li><p><em>Flexible</em>: Twig is powered by a flexible lexer and parser. This allows the
developer to define its own custom tags and filters, and create its own
DSL.</p></li>
</ul>

<h2>Prerequisites</h2>

<p>Twig needs at least <strong>PHP 5.2.4</strong> to run.</p>

<h2>Installation</h2>

<p>You have multiple ways to install Twig. If you are unsure what to do, go with
the tarball.</p>

<h3>From the tarball release</h3>

<ol>
<li>Download the most recent tarball from the <a href="http://www.twig-project.org/installation">download page</a></li>
<li>Unpack the tarball</li>
<li>Move the files somewhere in your project</li>
</ol>

<h3>Installing the development version</h3>

<ol>
<li>Install Subversion or Git</li>
<li>For Subversion: <code>svn co http://svn.twig-project.org/trunk/ twig</code>, for Git:
<code>git clone git://github.com/fabpot/Twig.git</code></li>
</ol>

<h3>Installing the PEAR package</h3>

<ol>
<li>Install PEAR</li>
<li>pear channel-discover pear.twig-project.org</li>
<li>pear install twig/Twig (or pear install twig/Twig-beta)</li>
</ol>

<h2>Basic API Usage</h2>

<p>This section gives you a brief introduction to the PHP API for Twig.</p>

<p>The first step to use Twig is to register its autoloader:</p>

<pre><code>[php]
require_once '/path/to/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
</code></pre>

<p>Replace the <code>/path/to/lib/</code> path with the path you used for Twig installation.</p>

<blockquote>
  <p><strong>NOTE</strong>
  Twig follows the PEAR convention names for its classes, which means you can
  easily integrate Twig classes loading in your own autoloader.</p>
</blockquote>

<pre><code>[php]
$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);

$template = $twig-&gt;loadTemplate('Hello {{ name }}!');

$template-&gt;display(array('name' =&gt; 'Fabien'));
</code></pre>

<p>Twig uses a loader (<code>Twig_Loader_String</code>) to locate templates, and an
environment (<code>Twig_Environment</code>) to store the configuration.</p>

<p>The <code>loadTemplate()</code> method uses the loader to locate and load the template
and returns a template object (<code>Twig_Template</code>) which is suitable for
rendering with the <code>display()</code> method.</p>

<p>Twig also comes with a filesystem loader:</p>

<pre><code>[php]
$loader = new Twig_Loader_Filesystem('/path/to/templates');
$twig = new Twig_Environment($loader, array(
  'cache' =&gt; '/path/to/compilation_cache',
));

$template = $twig-&gt;loadTemplate('index.html');
</code></pre>
