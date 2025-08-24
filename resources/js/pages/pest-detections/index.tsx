import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link } from '@inertiajs/react';

interface PestDetection {
    id: number;
    image_path: string;
    latitude: number | null;
    longitude: number | null;
    confidence_score: number | null;
    status: string;
    notes: string | null;
    created_at: string;
    verified_at: string | null;
    user: {
        name: string;
    };
    district: {
        name: string;
        regency: {
            name: string;
            province: {
                name: string;
            };
        };
    } | null;
    predicted_pest: {
        name: string;
        type: string;
    } | null;
    verified_pest: {
        name: string;
        type: string;
    } | null;
    verifier: {
        name: string;
    } | null;
}

interface Props {
    detections: {
        data: PestDetection[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    [key: string]: unknown;
}

export default function PestDetectionsIndex({ detections }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const getStatusBadge = (status: string) => {
        switch (status) {
            case 'verified':
                return (
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        ✅ Verified
                    </span>
                );
            case 'rejected':
                return (
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        ❌ Rejected
                    </span>
                );
            default:
                return (
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        ⏳ Pending
                    </span>
                );
        }
    };

    const getPestTypeIcon = (type: string) => {
        return type === 'pest' ? '🐛' : '🦠';
    };

    return (
        <>
            <Head title="Pest Detections" />
            <AppShell>
                <div className="space-y-6">
                    {/* Header */}
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                📷 Pest Detection History
                            </h1>
                            <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                AI-powered pest and disease detection results
                            </p>
                        </div>
                        <div className="mt-4 sm:mt-0">
                            <Link
                                href={route('pest-detections.create')}
                                className="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                            >
                                📸 Upload New Detection
                            </Link>
                        </div>
                    </div>

                    {/* Detections List */}
                    <div className="bg-white shadow rounded-lg dark:bg-gray-800">
                        <div className="overflow-hidden">
                            {detections.data.length > 0 ? (
                                <ul className="divide-y divide-gray-200 dark:divide-gray-700">
                                    {detections.data.map((detection) => (
                                        <li key={detection.id}>
                                            <Link
                                                href={route('pest-detections.show', detection.id)}
                                                className="block hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                            >
                                                <div className="px-6 py-4">
                                                    <div className="flex items-center justify-between">
                                                        <div className="flex items-center space-x-4">
                                                            <div className="flex-shrink-0">
                                                                <div className="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center dark:bg-gray-600">
                                                                    {detection.predicted_pest ? (
                                                                        getPestTypeIcon(detection.predicted_pest.type)
                                                                    ) : (
                                                                        '📸'
                                                                    )}
                                                                </div>
                                                            </div>
                                                            <div className="flex-1">
                                                                <div className="flex items-center space-x-2">
                                                                    <p className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                                        {detection.predicted_pest?.name || 'Unknown Detection'}
                                                                    </p>
                                                                    {getStatusBadge(detection.status)}
                                                                </div>
                                                                <div className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                                    <span>By {detection.user.name}</span>
                                                                    {detection.district && (
                                                                        <span className="mx-1">•</span>
                                                                    )}
                                                                    {detection.district && (
                                                                        <span>
                                                                            {detection.district.name}, {detection.district.regency.name}, {detection.district.regency.province.name}
                                                                        </span>
                                                                    )}
                                                                </div>
                                                                <div className="mt-1 text-xs text-gray-500">
                                                                    Detected: {formatDate(detection.created_at)}
                                                                    {detection.confidence_score && (
                                                                        <span className="ml-3">
                                                                            Confidence: {Math.round(detection.confidence_score * 100)}%
                                                                        </span>
                                                                    )}
                                                                    {detection.verified_at && detection.verifier && (
                                                                        <span className="ml-3">
                                                                            Verified by {detection.verifier.name} on {formatDate(detection.verified_at)}
                                                                        </span>
                                                                    )}
                                                                </div>
                                                                {detection.verified_pest && detection.verified_pest.name !== detection.predicted_pest?.name && (
                                                                    <div className="mt-1 text-xs text-orange-600">
                                                                        Expert correction: {detection.verified_pest.name}
                                                                    </div>
                                                                )}
                                                            </div>
                                                        </div>
                                                        <div className="flex-shrink-0">
                                                            <svg className="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            ) : (
                                <div className="text-center py-12">
                                    <div className="text-6xl mb-4">📷</div>
                                    <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100">No detections yet</h3>
                                    <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Start by uploading your first pest detection image
                                    </p>
                                    <div className="mt-4">
                                        <Link
                                            href={route('pest-detections.create')}
                                            className="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                                        >
                                            📸 Upload Detection
                                        </Link>
                                    </div>
                                </div>
                            )}
                        </div>

                        {/* Pagination */}
                        {detections.links.length > 3 && (
                            <div className="bg-white px-4 py-3 border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <div className="flex items-center justify-between">
                                    <div className="flex items-center space-x-1">
                                        {detections.links.map((link, index) => {
                                            if (link.url === null) {
                                                return (
                                                    <span
                                                        key={index}
                                                        className="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default dark:bg-gray-800 dark:border-gray-600"
                                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                                    />
                                                );
                                            }

                                            return (
                                                <Link
                                                    key={index}
                                                    href={link.url}
                                                    className={`relative inline-flex items-center px-4 py-2 text-sm font-medium border hover:bg-gray-50 dark:hover:bg-gray-700 ${
                                                        link.active
                                                            ? 'z-10 bg-green-50 border-green-500 text-green-600'
                                                            : 'bg-white border-gray-300 text-gray-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300'
                                                    }`}
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            );
                                        })}
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </AppShell>
        </>
    );
}