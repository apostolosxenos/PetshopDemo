<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html>
      <body>
        <h6 class="mt-2 ml-3">Λίστα Παραγγελιών</h6>
        <table border="1" align="center">
          <tr style="background-color:rebeccapurple; color:whitesmoke">
            <td>ID Παραγγελίας</td>
            <td>Όνομα</td>
            <td>Επώνυμο</td>
            <td>Email</td>
            <td>Κόστος</td>
          </tr>
          <xsl:for-each select="data/order">
            <tr style="text-align:center">
              <td>
                <xsl:value-of select="order_id"/>
              </td>
              <td>
                <xsl:value-of select="first_name"/>
              </td>
              <td>
                <xsl:value-of select="last_name"/>
              </td>
              <td>
                <xsl:value-of select="email"/>
              </td>
              <td>
                <xsl:value-of select="total_purchases"/>
 €
              </td>
            </tr>
          </xsl:for-each>
        </table>

        <h6 class="mt-2 ml-3">Δημοφιλέστερα Προϊόντα</h6>
        <table class="mb-2" border="1" align="center">
          <tr style="background-color:rebeccapurple; color:whitesmoke">
            <td>ID Προϊόντος</td>
            <td>Ονομασία</td>
            <td>Ποσότητα Πωλήσεων</td>
          </tr>
          <xsl:for-each select="data/popular_product">
            <tr style="text-align:center">
              <td>
                <xsl:value-of select="product_id"/>
              </td>
              <td>
                <xsl:value-of select="name"/>
              </td>
              <td>
                <xsl:value-of select="total_sold"/>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet> 