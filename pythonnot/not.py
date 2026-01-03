class Ogrenci:

    def __init__(self,ad,soyad,vize,final):
        self.ad = ad
        self.soyad = soyad
        self.vize = vize
        self.final = final

    def ortalama_hesaplayıcı(self):
        ortalama = self.vize * 0.4 * self.final * 0.6

        if ortalama >= 50:
            return "Geçti"
        elif ortalama <50:
            return "Kaldı"
        else:
            print("Hatalı Giriş Yaptınız")

ogrenci_listesi = []

while True:
    ad = input("İsim giriniz (Çıkmak için 'q' basınız:")
    if ad == "q":
        break
    soyad = input("Soyad giriniz:")
    vize = float(input("Vize Notunuzu Giriniz:"))
    final = float(input("Final notunuzu Giriniz:"))


    ogrenci = Ogrenci(ad,soyad,vize,final)
    ogrenci_listesi.append(ogrenci)


for ogrencii in ogrenci_listesi:
    not_durumu = ogrencii.ortalama_hesaplayıcı()
    print(f"{ogrencii.ad} {ogrencii.soyad} : {not_durumu}")