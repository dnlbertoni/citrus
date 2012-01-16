<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />		

  <?php echo $_scripts ?>
  <?php echo $_styles ?>
  <title><?php echo $title;?></title>
	
</head>

<body>

	<!-- header starts here -->
	<div id="header"><div id="header-content">	
		
		<h1 id="logo-text"><a href="index.html" title="">Autoservicio<span>Santa Lucia</span></a></h1>
		<h2 id="slogan">Put your site slogan here...</h2>		
		
		<div id="header-links">
			<p>
				<a href="index.html">Home</a> | 
				<a href="index.html">Contact</a> | 
				<a href="index.html">Site Map</a>			
			</p>		
		</div>	
	
	</div></div>
	
	<!-- navigation starts here -->
	<div id="nav-wrap">
          <div id="nav">
            <?php if(isset($menu)):?>
              <?php echo $menu?>
            <?php else:?>
              Falta definir el menu;
            <?php endif;?>
	</div>
        </div>
				
	<!-- content-wrap starts here -->
	<div id="content-wrap"><div id="content">	 
	
		<div id="sidebar" >	
		
				<div class="sep"></div>
				
				<div class="sidebox">
					<h1>Search Box</h1>	
					<form action="#" class="searchform">
						<p>
							<input name="search_query" class="textbox" type="text" />
  							<input name="search" class="button" value="Search" type="submit" />
						</p>			
					</form>
				</div>
		
				<div class="sidebox">
					<h1>Sidebar Menu</h1>
					<ul class="sidemenu">
						<li><a href="index.html">Home</a></li>
						<li><a href="#TemplateInfo">TemplateInfo</a></li>
						<li><a href="#SampleTags">Sample Tags</a></li>
						<li><a href="http://www.styleshout.com/">More Templates...</a> </li>
						<li><a href="http://www.dreamtemplate.com" title="Web Templates">Web Templates</a></li>
					</ul>		
				</div>
			
				<div class="sidebox">
					<h1>Sponsors</h1>
					<ul class="sidemenu">
                        <li><a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate</a></li>
				        <li><a href="http://www.themelayouts.com" title="WordPress Themes">ThemeLayouts</a></li>
				        <li><a href="http://www.imhosted.com" title="Website Hosting">ImHosted.com</a></li>
				        <li><a href="http://www.dreamstock.com" title="Stock Photos">DreamStock</a></li>
				        <li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a></li>
                        <li><a href="http://www.webhostingwp.com" title="Web Hosting">Web Hosting</a></li>
					</ul>
				</div>
			
				<div class="sidebox">
					<h1>Wise Words</h1>
			
					<p>&quot;Everybody thinks of changing humanity and nobody 
					thinks of changing himself.&quot;</p>		
			
					<p class="align-right">- Leo Tolstoy</p>		
				</div>
			
				<div class="sidebox">
					<h1>Support Styleshout</h1>			
					<p>If you are interested in supporting my work and would like to contribute, you are
					welcome to make a small donation through the 
					<a href="http://www.styleshout.com/">donate link</a> on my website - it will 
					be a great help and will surely be appreciated.
					</p>	
				</div>
				
				<div class="sidebox">
					<h1>RSS Feed</h1>
					<p><a href="index.html" ><img src="images/rssfeed.gif" alt="RSS Feed" class="rssfeed" /></a><br />
					subscribe to the <strong><a href="index.html" >rss feed</a></strong>
					</p>
				</div>	
				
		</div>	
	
		<div id="main">			
			<div class="box">
        			<a name="TemplateInfo"></a>
				<h1><a href="index.html">Template <span class="white">Info</span></a></h1>
				
				<p class="post-by">Posted by <a href="index.html">ealigam</a></p>
				
                <p><strong>BluePigment</strong> is a free, W3C-compliant, CSS-based website template
                by <a href="http://www.styleshout.com/">styleshout.com</a>. This work is
                distributed under the <a rel="license" href="http://creativecommons.org/licenses/by/2.5/">
                Creative Commons Attribution 2.5  License</a>, which means that you are free to
                use and modify it for any purpose. All I ask is that you give me credit by including a <strong>link back</strong> to
                <a href="http://www.styleshout.com/">my website</a>.
                </p>

                <p>
                You can find more of my free template designs at <a href="http://www.styleshout.com/">my website</a>.
                For premium commercial designs, you can check out
                <a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate.com</a>.
                </p>
				
				<p class="post-footer align-right">					
					<a href="index.html" class="readmore">Read more</a>
					<a href="index.html" class="comments">Comments (7)</a>
					<span class="date">Oct 01, 2006</span>	
				</p>
			
			</div>			
			
			<div class="box">
			
				<a name="SampleTags"></a>
				<h1><a href="index.html">Sample <span class="white">Tags</span></a></h1>
				
				<p class="post-by">Posted by <a href="index.html">ealigam</a></p>
				
				<h3>Code</h3>				
		
				<p><code>
				code-sample { <br />
				font-weight: bold;<br />
				font-style: italic;<br />				
				}
				</code></p>	
			
				<h3>Example Lists</h3>
		
				<ol>
					<li>Here is an example</li>
					<li>of an ordered list</li>								
				</ol>	
							
				<ul>
					<li>Here is an example</li>
					<li>of an unordered list</li>								
				</ul>			
			
				<h3>Blockquote</h3>			
				
				<blockquote><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy 
				nibh euismod tincidunt ut laoreet dolore magna aliquam erat....</p></blockquote>
			
				<h3>Image and text</h3>
				
				<p>
				<a href="http://getfirefox.com/"><img src="images/firefox-gray.jpg" width="100" height="121" alt="firefox-gray"  class="float-left" /></a>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
				Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
				posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
				odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra 
				condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. 
				In tristique orci porttitor ipsum. Aliquam ornare diam iaculis nibh. Proin luctus, velit pulvinar 
				ullamcorper nonummy, mauris enim eleifend urna, congue egestas elit lectus eu est. 								
				</p>
			
				<h3>Table Styling</h3>							
				
				<table>
					<tr>
						<th class="first"><strong>post</strong> date</th>
						<th>title</th>
						<th>description</th>
					</tr>
					<tr class="row-a">
						<td class="first">07.18.2007</td>
						<td><a href="index.html">Augue non nibh</a></td>
						<td><a href="index.html">Lobortis commodo metus vestibulum</a></td>
					</tr>
					<tr class="row-b">
						<td class="first">07.18.2007</td>
						<td><a href="index.html">Fusce ut diam bibendum</a></td>
						<td><a href="index.html">Purus in eget odio in sapien</a></td>
					</tr>
					<tr class="row-a">
						<td class="first">07.18.2007</td>
						<td><a href="index.html">Maecenas et ipsum</a></td>
						<td><a href="index.html">Adipiscing blandit quisque eros</a></td>
					</tr>
					<tr class="row-b">
						<td class="first">07.18.2007</td>
						<td><a href="index.html">Sed vestibulum blandit</a></td>
						<td><a href="index.html">Cras lobortis commodo metus lorem</a></td>
					</tr>
				</table>
			
				<h3>Example Form</h3>
				
				<form action="#">		
					<p>
						<label>Name</label>
						<input name="dname" value="Your Name" type="text" size="30" />
						<label>Email</label>
						<input name="demail" value="Your Email" type="text" size="30" />
						<label>Your Comments</label>
						<textarea rows="5" cols="5"></textarea>
						<br />	
						<input class="button" type="submit" />		
					</p>		
				</form>	
			
			</div>			
			
			<br />				
										
		</div>			
		
	
	<!-- content-wrap ends here -->		
	</div></div>

	<!-- footer starts here-->		
	<div id="footer-wrap">
	
		<div id="footer-columns">
			<div class="col3">
				<h2>Tincidunt</h2>
				<ul>
					<li><a href="index.html">consequat molestie</a></li>
					<li><a href="index.html">sem justo</a></li>
					<li><a href="index.html">semper</a></li>
					<li><a href="index.html">magna sed purus</a></li>
					<li><a href="index.html">tincidunt</a></li>
				</ul>
			</div>
			<div class="col3-center">
				<h2>Sed purus</h2>
				<ul>
					<li><a href="index.html">consequat molestie</a></li>
					<li><a href="index.html">sem justo</a></li>
					<li><a href="index.html">semper</a></li>
					<li><a href="index.html">magna sed purus</a></li>
					<li><a href="index.html">tincidunt</a></li>
				</ul>
			</div>
			<div class="col3">
				<h2>Praesent</h2>
				<ul>
					<li><a href="index.html">consequat molestie</a></li>
					<li><a href="index.html">sem justo</a></li>
					<li><a href="index.html">semper</a></li>
					<li><a href="index.html">magna sed purus</a></li>
					<li><a href="index.html">tincidunt</a></li>					
				</ul>
			</div>
		<!-- footer-columns ends -->
		</div>	
	
		<div id="footer-bottom">

            <p>
			&copy; 2010 Your Company

            &nbsp;&nbsp;&nbsp;&nbsp;

			<a href="http://www.bluewebtemplates.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a>

   		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			<a href="index.html">Home</a> |
   		    <a href="index.html">Sitemap</a> |
	   	    <a href="index.html">RSS Feed</a> |
            <a href="http://validator.w3.org/check?uri=referer">XHTML</a> |
			<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
			</p>

		</div>	

<!-- footer ends-->
</div>

</body>
</html>
