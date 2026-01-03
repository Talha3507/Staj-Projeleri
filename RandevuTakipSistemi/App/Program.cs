using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.IO;
using System.Text.Json;
using System.Diagnostics;
using System.Data;

namespace RandevuTakipSistemi
{
    class Program
    {
        static string dosya = "data.json";

        static void Main()
        {
            if (!File.Exists(dosya))
                File.WriteAllText(dosya, JsonSerializer.Serialize(new VeriModeli()));

            while (true)
            {
                Console.Clear();
                Console.WriteLine("1- Müşteri Ekle");
                Console.WriteLine("2- Randevu Ekle");
                Console.WriteLine("3- Randevuları Listele");
                Console.WriteLine("0- Çıkış");

                Console.Write("Seçim: ");
                var secim = Console.ReadLine();

                if (secim == "1") MusteriEkle();
                if (secim == "2") RandevuEkle();
                if (secim == "3") Listele();
                if (secim == "0") break;
            }
        }

        static VeriModeli Oku()
        {
            return JsonSerializer.Deserialize<VeriModeli>(File.ReadAllText(dosya));
        }

        static void Yaz(VeriModeli veri)
        {
            File.WriteAllText(
                dosya,
                JsonSerializer.Serialize(veri, new JsonSerializerOptions
                {
                    WriteIndented = true
                })
                );
        }

        static void MusteriEkle()
        {
            var veri = Oku();

            Console.Write("Ad Soyad: ");
            string ad = Console.ReadLine();

            Console.Write("Telefon: ");
            string tel = Console.ReadLine();

            veri.Musteriler.Add(new Musteri
            {
                Id = veri.Musteriler.Count + 1,
                AdSoyad = ad,
                Telefon = tel
            });

            Yaz(veri);
        }

        static void RandevuEkle()
        {
            var veri = Oku();

            if (!veri.Musteriler.Any())
            {
                Console.WriteLine("Önce Müşteri Ekle.");
                Console.ReadKey();
                return;
            }


            foreach (var m in veri.Musteriler)
                Console.WriteLine($"{m.Id} - {m.AdSoyad}");

            Console.Write("Müşteri Id: ");
            int mid = int.Parse(Console.ReadLine());

            Console.Write("Tarih (yyyy-MM-dd HH:mm): ");
            DateTime tarih = DateTime.Parse(Console.ReadLine());

            if (veri.Randevular.Any(r => r.Tarih == tarih))
            {
                Console.WriteLine("Bu saat dolu. ");
                Console.ReadKey();
                return;
            }

            Console.Write("Açıklama: ");
            string aciklama = Console.ReadLine();

            veri.Randevular.Add(new Randevu
            {
                Id = veri.Randevular.Count + 1,
                MusteriId = mid,
                Tarih = tarih,
                Aciklama = aciklama
            });

            Yaz(veri);
        }
        
        static void Listele()
        {
            var veri = Oku();

            foreach (var r in veri.Randevular)
            {
                var m = veri.Musteriler.First(x => x.Id == r.MusteriId);
                Console.WriteLine($"{r.Tarih} | {m.AdSoyad} | {r.Aciklama}");
            }

            Console.ReadKey();
        }
    }
}