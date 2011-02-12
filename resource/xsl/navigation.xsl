<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:param name="selected"/>
	<xsl:param name="webroot"/>
	<xsl:output encoding="utf-8" indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:template match="/">
		<ul id="navigation-list">
			<xsl:apply-templates select="/navigation"/>
		</ul>
	</xsl:template>
	
	<xsl:template match="item">
		<xsl:choose>
			<xsl:when test="@id = $selected">
				<li class="navigation-item navigation-item-selected">
					<xsl:value-of select="@title"/>
				</li>
			</xsl:when>
			<xsl:otherwise>
				<li class="navigation-item">
					<a href="{$webroot}{@link}"><xsl:value-of select="@title"/></a>
				</li>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<xsl:template match="section">
		<xsl:choose>
			<xsl:when test=".//item[@id = $selected]">
				<li class="navigation-section navigation-section-selected">
					<div class="navigation-section-op">-</div>
					<a class="navigation-section-link" onclick="toggleSezione(this, '{@id}');"><xsl:value-of select="@title"/></a>
					<ul class="navigation-section-list">
						<xsl:apply-templates />
					</ul>
				</li>
			</xsl:when>
			<xsl:otherwise>
				<li class="navigation-section">
					<div class="navigation-section-op">-</div>
					<a class="navigation-section-link" onclick="toggleSezione(this, '{@id}');"><xsl:value-of select="@title"/></a>
					<ul class="navigation-section-list">
						<xsl:apply-templates />
					</ul>
				</li>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<xsl:template match="separator">
		<li class="navigation-separator"></li>
	</xsl:template>
	
	<xsl:template match="label">
		<li class="navigation-label"><xsl:value-of select="@text"/></li>
	</xsl:template>
	
</xsl:stylesheet>
