import { ArrowRight, Video, Calendar, Shield, Activity, Users, Heart } from 'lucide-react';
import { Link } from 'react-router-dom';

export default function Home() {
  const features = [
    {
      icon: <Video className="h-6 w-6 text-indigo-600" />,
      title: "HD Video Consultations",
      description: "Crystal clear video calls with your healthcare provider from the comfort of your home."
    },
    {
      icon: <Calendar className="h-6 w-6 text-indigo-600" />,
      title: "Easy Scheduling",
      description: "Book appointments 24/7 with our intuitive scheduling system."
    },
    {
      icon: <Shield className="h-6 w-6 text-indigo-600" />,
      title: "Secure Platform",
      description: "Your health data is protected with state-of-the-art encryption."
    },
    {
      icon: <Activity className="h-6 w-6 text-indigo-600" />,
      title: "Real-time Monitoring",
      description: "Track your health metrics and receive instant feedback."
    },
    {
      icon: <Users className="h-6 w-6 text-indigo-600" />,
      title: "Expert Specialists",
      description: "Access to a network of certified healthcare professionals."
    },
    {
      icon: <Heart className="h-6 w-6 text-indigo-600" />,
      title: "Personalized Care",
      description: "Tailored healthcare plans that adapt to your needs."
    }
  ];

  return (
    <div className="flex flex-col">
      {/* Hero Section */}
      <section className="relative min-h-screen">
        <div className="absolute inset-0 bg-gradient-to-br from-indigo-600 via-blue-500 to-cyan-400 opacity-90"></div>
        <div className="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80')] bg-cover bg-center mix-blend-overlay"></div>
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-48">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div className="space-y-8 text-white">
              <h1 className="text-5xl md:text-6xl font-bold leading-tight animate-float">
                Healthcare at Your Fingertips
              </h1>
              <p className="text-xl text-blue-50 leading-relaxed">
                Connect with qualified healthcare professionals from the comfort of your home. Safe, secure, and convenient.
              </p>
              <div className="flex flex-wrap gap-4">
                <Link
                  to="/signup"
                  className="inline-flex items-center bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-lg"
                >
                  Sign Up Now
                  <ArrowRight className="ml-2 h-5 w-5" />
                </Link>
                <Link to="/services" className="btn-secondary">
                  Learn More
                </Link>
              </div>
            </div>
            <div className="hidden md:block">
              <img
                src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80"
                alt="Doctor using tablet"
                className="rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500 animate-float"
              />
            </div>
          </div>
        </div>

        {/* Wave SVG */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" className="w-full">
            <path fill="#f3f4f6" fillOpacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
          </svg>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 bg-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold text-gray-900 mb-4">Why Choose TéléSanté?</h2>
            <p className="text-xl text-gray-600">Experience healthcare designed for the modern world.</p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {features.map((feature, index) => (
              <div
                key={index}
                className="card p-8 group"
              >
                <div className="inline-block p-3 bg-indigo-50 rounded-lg mb-4 group-hover:bg-indigo-100 transition-colors duration-300">
                  {feature.icon}
                </div>
                <h3 className="text-xl font-semibold text-gray-900 mb-2">{feature.title}</h3>
                <p className="text-gray-600">{feature.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="relative py-20 overflow-hidden">
        <div className="absolute inset-0 bg-gradient-to-r from-indigo-600 to-blue-500"></div>
        <div className="absolute inset-0 bg-gradient-radial opacity-30"></div>
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-4xl font-bold text-white mb-4">Ready to Get Started?</h2>
          <p className="text-xl text-blue-100 mb-8">Join thousands of satisfied users who trust TéléSanté</p>
          <Link
            to="/signup"
            className="inline-flex items-center bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transform hover:scale-105 transition-all duration-300 shadow-lg"
          >
            Sign Up Now
            <ArrowRight className="ml-2 h-5 w-5" />
          </Link>
        </div>
      </section>
    </div>
  );
}
