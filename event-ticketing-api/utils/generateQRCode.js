const QRCode = require("qrcode");

const generateQRCode = async (text) => {
  try {
    const qr = await QRCode.toDataURL(text);
    return qr;
  } catch (err) {
    console.error("QR Code generation failed:", err);
    throw err;
  }
};

module.exports = generateQRCode;
