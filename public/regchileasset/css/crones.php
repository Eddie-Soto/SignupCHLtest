<?php 



$insert_sql = "";

if($sku == "")

{

	$insert_sql = "IN (SELECT H1.ItemCode FROM ORDR H0 INNER JOIN RDR1 H1 ON H0.DocEntry = H1.DocEntry WHERE H0.DocDate between '$date_init' and '$date_out' UNION SELECT distinct H0.ITEMCODE as Codigo FROM OITM H0 WHERE H0.[updateDate] between '$date_init' and '$date_out') ORDER BY T0.[QryGroup56] ASC";

}

else

{

	$insert_sql = " = '$sku'";

}



/*Mexico*/

$sql_query = "SELECT DISTINCT

T0.[ItemCode] as sku,

T0.[ItemName] as nombre,

T0.[U_Marca] as marca,

T0.[U_FrecCambio] as frecuencia_cambio,

T0.[QryGroup58] as cliente_elite,

T0.[U_Repuesto] as repuestos,

T0.u_Piezas as piezas,



(SELECT H1.[Code] + '-' + CAST(cast(H1.[quantity] as int) as varchar) + ',' FROM OITT H0  INNER JOIN ITT1 H1 ON H0.Code = H1.Father INNER JOIN OITM H2 ON H1.code = H2.itemcode INNER JOIN OITB H3 ON H2.[ItmsGrpCod] = H3.[ItmsGrpCod] WHERE T0.ItemCode = H0.[Code] and H3.[ItmsGrpNam] not in ('761 Training Expense', '970 Spanish Sales Ai', '970 Spanish Sale Ai', '970 Spanish Sales Aid', '970 Spanish Sale Aid') ORDER BY H1.[Code] FOR XML PATH('') ) AS componentes_cantidad,

(SELECT H1.[Code] + ',' FROM OITT H0  INNER JOIN ITT1 H1 ON H0.Code = H1.Father WHERE T0.[ItemCode] = H0.[Code] ORDER BY H1.[Code] FOR XML PATH('') ) AS componentes,

(SELECT TOP 1 H1.[Price] FROM OITM H0 INNER JOIN ITM1 H1 ON H0.ItemCode = H1.ItemCode WHERE H0.[ItemCode] = T0.[ItemCode] and H1.[PriceList] = '1') as precio_mayoreo,

(SELECT TOP 1 H1.[Price] FROM OITM H0 INNER JOIN ITM1 H1 ON H0.ItemCode = H1.ItemCode WHERE H0.[ItemCode] = T0.[ItemCode] and H1.[PriceList] = '2') as precio_sugerido,

ISNULL(T0.[U_Flete_Incluido], 0) as flete,

ISNULL(T0.[U_Puntos], 0) as puntos,

ISNULL(T0.[U_vol_calc], 0) as vc_mayoreo,

ISNULL(T0.[U_vol_calc_sug], 0) as vc_sugerido,

ISNULL(T0.[U_menudeo_comis], 0) as menudeo,



T0.[VATLiable] as aplica_iva,

T0.[InvntItem] as inventariable,

T1.[OnHand] as inventario,



CASE WHEN CONVERT(VARCHAR(10),T0.[validTo],110) IS NULL THEN '01-01-2030' ELSE CONVERT(VARCHAR(10),T0.[validTo],110) END as valido_hasta,

CASE WHEN CONVERT(VARCHAR(10),T0.[validFrom],110) IS NULL THEN '12-31-1969' ELSE CONVERT(VARCHAR(10),T0.[validFrom],110) END as valido_desde,

T0.[frozenFor] as estatus,



T4.U_Descripcion as grupo_sap,

T5.U_Descripcion as subgrupo_sap,

T0.U_BOY_TB_0 as aplica_lista_sap,

T6.ItmsGrpNam as categoria_sap,

T0.u_tipoventa as tipo_sap,

T0.[QryGroup56] as backorder,

'2' as country,

(SELECT TOP 1 H1.[Price] FROM OITM H0 INNER JOIN ITM1 H1 ON H0.ItemCode = H1.ItemCode WHERE H0.[ItemCode] = T0.ITEMCODE+'M' and H1.[PriceList] = '2') as meses,

'0' as vc_rebate



FROM OITM T0  INNER JOIN OITW T1 ON T0.ItemCode = T1.ItemCode LEFT JOIN [@grupo] T4 ON T0.U_Grupo = T4.code LEFT JOIN [@subgrupo] T5 ON T0.U_SubGrupo = T5.code INNER JOIN OITB T6 ON T0.ItmsGrpCod = T6.ItmsGrpCod

WHERE

T1.[WhsCode] IN ('100') AND T0.ItemCode $insert_sql";

/*Mexico*/



if($sku == "")

{

	if($ambient == "TEST")

	{

		Update_products_TEST($sql_query, "2");

	}

	else

	{

		Update_products($sql_query, "2");	

	}

}

else

{

	Update_products_TEST($sql_query, "2");

	Update_products($sql_query, "2");	

}



?>