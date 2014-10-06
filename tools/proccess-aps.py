#!/usr/bin/env python
#! coding: utf-8

import os, sys, codecs
from BeautifulSoup import BeautifulSoup
from slugify import slugify
import json
import requests

months = ['', 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez']
url = "http://blog.telessaudebrasil.org.br/?paged=%s"


posts = []
for i in range(1,75):
	curr_url = url % i
	# print curr_url

	r = requests.get(curr_url)
	bs = BeautifulSoup(r.content, convertEntities=BeautifulSoup.HTML_ENTITIES)

	post = {}
	for div in bs.findAll('div', attrs={'id': True}):
		if div.get('id').startswith('post-'):
			
			post['id'] = div.get('id').replace("post-", "") 
			post['title'] = div.find('h2').text
			post['content'] = div.find('div', attrs={'class': 'entry'})
			post['category'] = div.find(True, attrs={'class': 'postmetadata'}).find('a', attrs={'rel': 'category'}).text

			day, mon, yea = div.find('span', attrs={'class': 'date'}).text.split(" ")
			mon = months.index(mon)
			post['date'] = "%s-%02d-%02d 01:00:00" % (yea, int(mon), int(day))

			
			posts.append(post)
			post = {}
			# print div
			# raw_input()
# sys.exit()
# headers = {
# 	'Bibliografia selecionada:': 'bibliografia_selecionada',
# 	'Revisão em: ': 'revisao',
	
# 	'Categoria da Evidência: ': 'observacoes',
# 	# 'Data:': '',
# 	# 'Educação Permanente': '',
# 	# 'Profissional solicitante: ': '',
# 	# 'Descritores DeCS: ': '',
# 	'Descritores ICPC2: ': '',
# 	# 'Teleconsultor: ': '',


# }

# set up output encoding
if not sys.stdout.isatty():
    # here you can set encoding for your 'out.txt' file
    sys.stdout = codecs.getwriter('utf8')(sys.stdout)

# if len(sys.argv) < 2:
# 	print "use: ./proccess-aps.py <file_to_proccess>"
# 	sys.exit(1)

# FILE=sys.argv[1]

# file_content = ""
# with open(FILE) as handle:
# 	file_content = handle.read()

# bs = BeautifulSoup(file_content, convertEntities=BeautifulSoup.HTML_ENTITIES)

# items = []
# for question in bs.findAll('item'):

# 	post_type = question.find("wp:post_type")
# 	if post_type:
# 		if post_type.string != "post":
# 			continue

# 	title = question.find('title').string
# 	id = question.find('wp:post_id').string
# 	post_date = question.find('wp:post_date').string
# 	post_date_gmt = question.find('wp:post_date_gmt').string

# 	status = 'pending'
# 	if question.find('wp:status').string == "pending":
# 		status = 'draft'
	
# 	if not title:
# 		continue

# 	tax = ""
# 	for item in question.find('content:encoded'):

# 		content = item.string
# 		bs2 = BeautifulSoup(content, convertEntities=BeautifulSoup.HTML_ENTITIES)

# 		description = content.split("<strong>")[0]

# 		for item2 in bs2.findAll('strong'):
# 			try:
# 				head = item2.string.encode('utf-8')
# 				content = item2.nextSibling.string.replace('\r', '')
# 			except:
# 				continue

# 			if 'Profissional solicitante' in head:
# 				for prof1 in content.split(","):
# 					for prof2 in prof1.split(" e "):
# 						prof2 = prof2.replace(":", '').strip()
# 						tax += '<category domain="tipo-de-profissional" nicename="%s"><![CDATA[%s]]></category>' % (slugify(prof2).lower(), prof2)
# 				continue

# 			if 'Descritores DeCS' in head:
# 				for decs in content.split(";"):
# 					decs = decs.replace(":", '').strip()
# 					if decs:
# 						tax += '<category domain="decs" nicename="%s"><![CDATA[%s]]></category>' % (slugify(decs).lower(), decs)
# 				continue

					
# 			if 'CIAP1' in head or 'CIAP 1' in head:
# 				content = content.replace(":", '').strip()
# 				if content:
# 					tax += '<category domain="ciap1" nicename="%s"><![CDATA[%s]]></category>' % (slugify(content).lower(), content)
# 				continue

# 			if 'Teleconsultor' in head:
# 				content = content.replace(":", '').strip()
# 				tax += '<category domain="teleconsultor" nicename="%s"><![CDATA[%s]]></category>' % (slugify(content).lower(), content)
# 				continue

# 			if 'CIAP2' in head or 'CIAP 2' in head or 'ICPC2' in head:
# 				for ciap2 in content.split(";"):
# 					ciap2 = ciap2.replace(":", '').strip()
# 					tax += '<category domain="ciap2" nicename="%s"><![CDATA[%s]]></category>' % (slugify(ciap2).lower(), ciap2)
# 				continue

# 			if head in headers and headers[head]:

# 				if content.strip():
# 					tax += """<wp:postmeta>
# 					<wp:meta_key>%s</wp:meta_key>
# 					<wp:meta_value><![CDATA[%s]]></wp:meta_value>
# 					</wp:postmeta>""" % (headers[head], content.strip())
			
# 			# if 'Categoria da Evidência' in head:
				
# 			# 	content = content.replace(":", '').strip()
# 			# 	tax += '<category domain="categoria-da-evidencia" nicename="%s"><![CDATA[%s]]></category>' % (slugify(content).lower(), content)
		

# 			# print "'%s': ''," % head
# 			# print "content: %s" % content
# 			# print 
# 			# print 

items = []
for post in posts:

	tax = '<category domain="categoria-da-evidencia" nicename="%s"><![CDATA[%s]]></category>' % (slugify(post['category']).lower(), post['category'])

	item = """
	<item>
		<wp:post_date>%s</wp:post_date>
		<wp:post_date_gmt>%s</wp:post_date_gmt>
		<title>%s</title>
		<dc:creator><![CDATA[admin]]></dc:creator>
		
		<description></description>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>%s</wp:post_id>
		<wp:comment_status>open</wp:comment_status>
		<wp:ping_status>open</wp:ping_status>
		<wp:post_name></wp:post_name>
		<wp:status>%s</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>aps</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>

		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_bibliografia_selecionada</wp:meta_key>
			<wp:meta_value><![CDATA[field_53cfeca0072fe]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_revisao</wp:meta_key>
			<wp:meta_value><![CDATA[field_53cfecc8072ff]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_observacoes</wp:meta_key>
			<wp:meta_value>field_53da42bb7a1f3</wp:meta_value>
		</wp:postmeta>

		%s

		<content:encoded><![CDATA[%s]]></content:encoded>
	</item>	
	""" % (post['date'], post['date'], post['title'], post['id'], 'pending', tax, post['content'])

	items.append(item)
	
header = u"""
<?xml version="1.0" encoding="UTF-8"?>
<!-- This is a WordPress eXtended RSS file generated by WordPress as an export of your blog. -->
<!-- It contains information about your blog's posts, comments, and categories. -->
<!-- You may use this file to transfer that content from one site to another. -->
<!-- This file is not intended to serve as a complete backup of your blog. -->

<!-- To import this information into a WordPress blog follow these steps. -->
<!-- 1. Log in to that blog as an administrator. -->
<!-- 2. Go to Tools: Import in the blog's admin panels (or Manage: Import in older versions of WordPress). -->
<!-- 3. Choose "WordPress" from the list. -->
<!-- 4. Upload this file using the form provided on that page. -->
<!-- 5. You will first be asked to map the authors in this export file to users -->
<!--    on the blog.  For each author, you may choose to map to an -->
<!--    existing user on the blog or to create a new user -->
<!-- 6. WordPress will then import each of the posts, comments, and categories -->
<!--    contained in this file into your blog -->

<!-- generator="WordPress/3.0.1" created="2014-07-22 18:58"-->
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.0/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.0/"
>

<channel>
	<title>Pearls Telessaúde Brasil</title>
	<link>http://www.bvsaps.dev</link>
	<description>Revisões sistemáticas traduzidas ao português</description>
	<pubDate>Thu, 28 Oct 2010 17:13:23 +0000</pubDate>
	<generator>http://wordpress.org/?v=3.0.1</generator>
	<language>en</language>
	<wp:wxr_version>1.0</wp:wxr_version>
	<wp:base_site_url>http://www.bvsaps.dev</wp:base_site_url>
	<wp:base_blog_url>http://www.bvsaps.dev</wp:base_blog_url>
			
	<generator>http://wordpress.org/?v=3.0.1</generator>
"""

middle = ""
count = 0
for item in items: 
	count += 1
	
	# if count < 10: continue
	# if count == 50: break
	
	middle += item

footer = "</channel></rss>"
print header + middle + footer