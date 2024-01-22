import React from "react";
import OrganizationChartPDF from "../../../assets/pdf/organization_chart.pdf";

function OrganizationChart() {
  const pdfUrl = OrganizationChartPDF;

  // ブラウザのウィンドウの高さを取得
  const screenHeight = window.innerHeight + 'px';

  return (
    <>
      <div style={{ height: screenHeight, overflow: "hidden"} }>
        <object
          data={pdfUrl}
          type="application/pdf"
          style={{
            width: "100%",
            height: "100%",
            border: "none",
            outline: "none",
          }}
        >
          {/* PDFがサポートされていない場合のフォールバックとしてメッセージを表示 */}
          <p>PDFファイルを表示することができません。PDFをダウンロードしてください：<a className="btn ml-8" href={pdfUrl}>PDFをダウンロード</a></p>
        </object>
      </div>
    </>
  );
}

export default OrganizationChart;
