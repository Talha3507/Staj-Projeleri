using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace RandevuTakipSistemi
{
    public class Musteri
    {
        public int Id { get; set; }
        public string? AdSoyad { get; set; }
        public string? Telefon { get; set; }
    }

    public class Randevu
    {
        public int Id { get; set; }
        public int MusteriId { get; set; }
        public DateTime Tarih { get; set; }
        public string? Aciklama { get; set; }
    }

    public class VeriModeli
    {
        public List<Musteri> Musteriler { get; set; } = new();
        public List<Randevu> Randevular { get; set; } = new();
    }
}