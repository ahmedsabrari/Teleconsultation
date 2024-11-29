import {Search } from 'lucide-react';
import { useState } from 'react';

export default function Services() {
  const [searchTerm, setSearchTerm] = useState('');

  const services = [
    {
      title: "General Consultation",
      description: "Connect with general practitioners for routine check-ups, minor illnesses, and health advice.",
      image: "https://images.unsplash.com/photo-1666214280557-f1b5022eb634?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["24/7 Availability", "Video Consultations", "Prescription Services"]
    },
    {
      title: "Mental Health",
      description: "Access professional mental health support from licensed therapists and counselors.",
      image: "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["Private Sessions", "Stress Management", "Behavioral Therapy"]
    },
    {
      title: "Pediatrics",
      description: "Specialized care for children with experienced pediatricians available 24/7.",
      image: "https://images.unsplash.com/photo-1666214280533-b9c78f16baa4?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["Child Development", "Vaccination Planning", "Emergency Care"]
    },
    {
      title: "Dermatology",
      description: "Get expert skin care advice and treatment plans from certified dermatologists.",
      image: "https://images.unsplash.com/photo-1576671081837-49000212a370?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["Skin Analysis", "Treatment Plans", "Follow-up Care"]
    },
    {
      title: "Chronic Care Management",
      description: "Ongoing support and monitoring for chronic conditions with specialized care plans.",
      image: "https://images.unsplash.com/photo-1631815589968-fdb09a223b1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["Regular Monitoring", "Medication Management", "Lifestyle Guidance"]
    },
    {
      title: "Nutrition Counseling",
      description: "Personalized nutrition advice and diet plans from registered dietitians.",
      image: "https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80",
      features: ["Diet Planning", "Nutritional Analysis", "Weight Management"]
    }
  ];

  const filteredServices = services.filter(service =>
    service.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
    service.description.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="bg-gray-50 min-h-screen">
      {/* Hero Section */}
      <div className="relative bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-24">
        <div className="absolute inset-0 bg-black opacity-50"></div>
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-6">Our Medical Services</h1>
            <p className="text-xl text-blue-100 max-w-2xl mx-auto">
              Comprehensive healthcare services delivered through our secure telehealth platform
            </p>
          </div>

          {/* Search Bar */}
          <div className="max-w-xl mx-auto mt-8">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" />
              <input
                type="text"
                placeholder="Search services..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full pl-10 pr-4 py-3 rounded-lg bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50"
              />
            </div>
          </div>
        </div>
      </div>

      {/* Services Grid */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {filteredServices.map((service, index) => (
            <div
              key={index}
              className="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
            >
              <div className="relative h-48 overflow-hidden">
                <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                <img
                  src={service.image}
                  alt={service.title}
                  className="w-full h-full object-cover transform group-hover:scale-110 transition duration-500"
                />
              </div>
              <div className="p-6">
                <h3 className="text-xl font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                  {service.title}
                </h3>
                <p className="text-gray-600 mb-4">{service.description}</p>

                {/* Features */}
                <div className="space-y-2 mb-4">
                  {service.features.map((feature, idx) => (
                    <div key={idx} className="flex items-center text-sm text-gray-500">
                      <div className="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                      {feature}
                    </div>
                  ))}
                </div>

              
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
