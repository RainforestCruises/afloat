<?xml version="1.0" encoding="UTF-8"?>
<configuration>
  <system.webServer>
    <staticContent name="Imagify: webp file type 1">
	<mimeMap fileExtension=".webp" mimeType="image/webp"/>
</staticContent>
    <rewrite>
      <rules>
        <rule name="WordPress: http://rfcweb.azurewebsites.net" patternSyntax="Wildcard">
          <match url="*"/>
          <conditions>
            <add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true"/>
            <add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true"/>
          </conditions>
          <action type="Rewrite" url="index.php"/>
        </rule>
        <rule name="Redirect domain.com to www" patternSyntax="Wildcard" stopProcessing="true">
          <match url="*"/>
          <conditions>
            <add input="{HTTP_HOST}" pattern="rainforestcruises.com"/>
          </conditions>
          <action type="Redirect" url="https://www.rainforestcruises.com/{R:0}"/>
        </rule>
      </rules>
      <outboundRules>
        <rule name="Noindex Domains">
          <match serverVariable="RESPONSE_X_Robots_Tag" pattern=".*"/>
          <conditions>
            <add input="{HTTP_HOST}" pattern="^rfcweb\.azurewebsites\.net$"/>
          </conditions>
          <action type="Rewrite" value="NOINDEX, NOFOLLOW"/>
        </rule>
      </outboundRules>
    </rewrite>
    <staticContent>
      <mimeMap fileExtension="woff" mimeType="application/font-woff"/>
      <mimeMap fileExtension="woff2" mimeType="application/font-woff2"/>
      <mimeMap fileExtension=".ttf" mimeType="application/octet-stream"/>
      <mimeMap fileExtension=".ttc" mimeType="application/octet-stream"/>
      <mimeMap fileExtension=".otf" mimeType="application/octet-stream"/>
    </staticContent>
  </system.webServer>
</configuration>
