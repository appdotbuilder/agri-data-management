import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface PestDetection {
    id: number;
    image_path: string;
    confidence_score: number | null;
    status: string;
    created_at: string;
    user: {
        name: string;
    };
    district: {
        name: string;
    } | null;
    predicted_pest: {
        name: string;
        type: string;
    } | null;
}

interface Commodity {
    id: number;
    name: string;
    description: string | null;
    varieties: Array<{
        id: number;
        name: string;
        potential_yield: number | null;
    }>;
    pests: Array<{
        id: number;
        name: string;
        type: string;
    }>;
}

interface Statistics {
    provinces: number;
    districts: number;
    commodities: number;
    varieties: number;
    pests: number;
    pest_detections: number;
    pending_verifications: number;
}

interface Props {
    statistics: Statistics;
    recentDetections: PestDetection[];
    commodities: Commodity[];
    [key: string]: unknown;
}

export default function AgricultureDashboard({ statistics, recentDetections, commodities }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'verified':
                return 'bg-green-100 text-green-800';
            case 'rejected':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-yellow-100 text-yellow-800';
        }
    };

    return (
        <>
            <Head title="Agriculture Dashboard" />
            <AppShell>
                <div className="space-y-8">
                    {/* Header */}
                    <div className="bg-gradient-to-r from-green-600 to-blue-600 rounded-lg p-6 text-white">
                        <h1 className="text-3xl font-bold mb-2">🌾 Agriculture Data Management</h1>
                        <p className="text-lg opacity-90">
                            Comprehensive platform for managing agricultural data, varieties, and pest detection
                        </p>
                    </div>

                    {/* Statistics Cards */}
                    <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-green-600">{statistics.provinces}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">🗺️ Provinces</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-blue-600">{statistics.districts}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">🏘️ Districts</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-purple-600">{statistics.commodities}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">🌱 Commodities</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-indigo-600">{statistics.varieties}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">🧬 Varieties</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-red-600">{statistics.pests}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">🐛 Pests</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-orange-600">{statistics.pest_detections}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">📷 Detections</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                            <div className="text-2xl font-bold text-yellow-600">{statistics.pending_verifications}</div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">⏳ Pending</div>
                        </div>
                    </div>

                    <div className="grid lg:grid-cols-2 gap-8">
                        {/* Recent Pest Detections */}
                        <div className="bg-white rounded-lg shadow dark:bg-gray-800">
                            <div className="p-6 border-b dark:border-gray-700">
                                <h2 className="text-xl font-semibold flex items-center">
                                    📷 Recent Pest Detections
                                </h2>
                            </div>
                            <div className="p-6">
                                <div className="space-y-4">
                                    {recentDetections.length > 0 ? (
                                        recentDetections.map((detection) => (
                                            <div key={detection.id} className="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                                                <div className="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center dark:bg-gray-600">
                                                    📸
                                                </div>
                                                <div className="flex-1">
                                                    <div className="font-medium">
                                                        {detection.predicted_pest?.name || 'Unknown Pest'}
                                                    </div>
                                                    <div className="text-sm text-gray-600 dark:text-gray-300">
                                                        by {detection.user.name} • {detection.district?.name || 'Unknown Location'}
                                                    </div>
                                                    <div className="text-xs text-gray-500">
                                                        {formatDate(detection.created_at)}
                                                        {detection.confidence_score && (
                                                            <span className="ml-2">
                                                                Confidence: {Math.round(detection.confidence_score * 100)}%
                                                            </span>
                                                        )}
                                                    </div>
                                                </div>
                                                <div className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(detection.status)}`}>
                                                    {detection.status === 'pending' && '⏳ Pending'}
                                                    {detection.status === 'verified' && '✅ Verified'}
                                                    {detection.status === 'rejected' && '❌ Rejected'}
                                                </div>
                                            </div>
                                        ))
                                    ) : (
                                        <div className="text-center text-gray-500 py-8">
                                            <div className="text-4xl mb-2">📷</div>
                                            <div>No pest detections yet</div>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>

                        {/* Commodities Overview */}
                        <div className="bg-white rounded-lg shadow dark:bg-gray-800">
                            <div className="p-6 border-b dark:border-gray-700">
                                <h2 className="text-xl font-semibold flex items-center">
                                    🌱 Commodities Overview
                                </h2>
                            </div>
                            <div className="p-6">
                                <div className="space-y-6">
                                    {commodities.map((commodity) => (
                                        <div key={commodity.id} className="border-l-4 border-green-500 pl-4">
                                            <div className="font-medium text-lg">{commodity.name}</div>
                                            <div className="text-sm text-gray-600 mb-2 dark:text-gray-300">
                                                {commodity.description}
                                            </div>
                                            <div className="flex flex-wrap gap-4 text-sm">
                                                <div className="flex items-center space-x-1">
                                                    <span className="text-blue-600">🧬</span>
                                                    <span>{commodity.varieties.length} Varieties</span>
                                                </div>
                                                <div className="flex items-center space-x-1">
                                                    <span className="text-red-600">🐛</span>
                                                    <span>{commodity.pests.length} Known Pests</span>
                                                </div>
                                            </div>
                                            {commodity.varieties.length > 0 && (
                                                <div className="mt-2">
                                                    <div className="text-xs text-gray-500 mb-1">Top Varieties:</div>
                                                    <div className="flex flex-wrap gap-2">
                                                        {commodity.varieties.slice(0, 3).map((variety) => (
                                                            <span
                                                                key={variety.id}
                                                                className="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"
                                                            >
                                                                {variety.name}
                                                                {variety.potential_yield && (
                                                                    <span className="ml-1 opacity-75">
                                                                        ({variety.potential_yield}t/ha)
                                                                    </span>
                                                                )}
                                                            </span>
                                                        ))}
                                                    </div>
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Quick Actions */}
                    <div className="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
                        <h2 className="text-xl font-semibold mb-4">🚀 Quick Actions</h2>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <button className="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors group dark:border-gray-600 dark:hover:border-green-500 dark:hover:bg-green-900/20">
                                <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📷</div>
                                <div className="text-sm font-medium">Upload Detection</div>
                            </button>
                            <button className="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group dark:border-gray-600 dark:hover:border-blue-500 dark:hover:bg-blue-900/20">
                                <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">🌱</div>
                                <div className="text-sm font-medium">Add Variety</div>
                            </button>
                            <button className="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors group dark:border-gray-600 dark:hover:border-purple-500 dark:hover:bg-purple-900/20">
                                <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">🐛</div>
                                <div className="text-sm font-medium">Manage Pests</div>
                            </button>
                            <button className="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition-colors group dark:border-gray-600 dark:hover:border-indigo-500 dark:hover:bg-indigo-900/20">
                                <div className="text-2xl mb-2 group-hover:scale-110 transition-transform">📊</div>
                                <div className="text-sm font-medium">View Reports</div>
                            </button>
                        </div>
                    </div>
                </div>
            </AppShell>
        </>
    );
}