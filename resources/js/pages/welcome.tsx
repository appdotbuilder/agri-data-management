import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="AgriManage - Smart Agricultural Data Management">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-green-50 to-blue-50 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
                <header className="mb-8 w-full max-w-6xl">
                    <nav className="flex items-center justify-between">
                        <div className="flex items-center space-x-2">
                            <div className="flex items-center justify-center w-10 h-10 bg-green-600 text-white rounded-lg">
                                🌾
                            </div>
                            <span className="text-xl font-bold">AgriManage</span>
                        </div>
                        <div className="flex items-center gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                                >
                                    🏡 Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-700 hover:text-green-600 transition-colors dark:text-gray-300"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                                    >
                                        Get Started
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                <main className="w-full max-w-6xl">
                    {/* Hero Section */}
                    <div className="text-center mb-16">
                        <h1 className="text-4xl lg:text-6xl font-bold mb-6 bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                            🌾 Smart Agricultural Data Management
                        </h1>
                        <p className="text-xl lg:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto dark:text-gray-300">
                            Comprehensive platform for managing agricultural data, from geographic information to pest detection using AI technology
                        </p>
                        {!auth.user && (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition-colors shadow-lg"
                                >
                                    🚀 Start Managing Data
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="inline-flex items-center px-8 py-3 bg-white text-green-600 border-2 border-green-600 rounded-lg text-lg font-semibold hover:bg-green-50 transition-colors"
                                >
                                    🔐 Sign In
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 dark:bg-green-900">
                                <span className="text-2xl">🗺️</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">Geographic Data</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Manage provinces, regencies, and districts with comprehensive agronomic data including soil nutrients and cropping indices
                            </p>
                        </div>

                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 dark:bg-blue-900">
                                <span className="text-2xl">🌱</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">Commodity Management</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Track soybean, peanut, and mung bean varieties with detailed specifications and yield potential data
                            </p>
                        </div>

                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4 dark:bg-red-900">
                                <span className="text-2xl">🐛</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">Pest & Disease Control</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Comprehensive database of pests and diseases with detailed control methods and treatment recommendations
                            </p>
                        </div>

                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 dark:bg-purple-900">
                                <span className="text-2xl">🤖</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">AI Pest Detection</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Upload images for AI-powered pest detection with confidence scoring and expert verification system
                            </p>
                        </div>

                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4 dark:bg-yellow-900">
                                <span className="text-2xl">📊</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">Data Analytics</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Generate insights from agricultural data with productivity analysis and improvement recommendations
                            </p>
                        </div>

                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow dark:bg-gray-800">
                            <div className="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 dark:bg-indigo-900">
                                <span className="text-2xl">👥</span>
                            </div>
                            <h3 className="text-xl font-semibold mb-3">User Management</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Role-based access control for admins, experts, and users with region-specific work assignments
                            </p>
                        </div>
                    </div>

                    {/* Stats Section */}
                    <div className="bg-white rounded-xl shadow-lg p-8 mb-16 dark:bg-gray-800">
                        <h2 className="text-2xl font-bold text-center mb-8">📈 Platform Overview</h2>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                            <div className="text-center">
                                <div className="text-3xl font-bold text-green-600 mb-2">5+</div>
                                <div className="text-gray-600 dark:text-gray-300">Provinces</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-blue-600 mb-2">60+</div>
                                <div className="text-gray-600 dark:text-gray-300">Districts</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-purple-600 mb-2">3</div>
                                <div className="text-gray-600 dark:text-gray-300">Main Commodities</div>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl font-bold text-red-600 mb-2">50+</div>
                                <div className="text-gray-600 dark:text-gray-300">Pest Types</div>
                            </div>
                        </div>
                    </div>

                    {/* CTA Section */}
                    {!auth.user && (
                        <div className="bg-gradient-to-r from-green-600 to-blue-600 rounded-xl p-8 text-center text-white">
                            <h2 className="text-3xl font-bold mb-4">🚀 Ready to Get Started?</h2>
                            <p className="text-xl mb-6 opacity-90">
                                Join thousands of agricultural professionals managing their data smarter
                            </p>
                            <Link
                                href={route('register')}
                                className="inline-flex items-center px-8 py-3 bg-white text-green-600 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors"
                            >
                                🌾 Create Account Now
                            </Link>
                        </div>
                    )}

                    {auth.user && (
                        <div className="bg-gradient-to-r from-green-600 to-blue-600 rounded-xl p-8 text-center text-white">
                            <h2 className="text-3xl font-bold mb-4">👋 Welcome back, {auth.user.name}!</h2>
                            <p className="text-xl mb-6 opacity-90">
                                Continue managing your agricultural data
                            </p>
                            <Link
                                href={route('dashboard')}
                                className="inline-flex items-center px-8 py-3 bg-white text-green-600 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors"
                            >
                                🏡 Go to Dashboard
                            </Link>
                        </div>
                    )}
                </main>

                <footer className="mt-16 text-center text-gray-600 dark:text-gray-400">
                    <p>Built with 💚 for Indonesian Agriculture</p>
                </footer>
            </div>
        </>
    );
}