import React, { useState } from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, router, useForm } from '@inertiajs/react';

interface District {
    id: number;
    name: string;
    regency: {
        name: string;
        province: {
            name: string;
        };
    };
}

interface Pest {
    id: number;
    name: string;
    type: string;
}

interface PestDetectionForm {
    district_id: string;
    predicted_pest_id: string;
    image: File | null;
    latitude: string;
    longitude: string;
    confidence_score: string;
    notes: string;
    [key: string]: string | File | null;
}

interface Props {
    districts: District[];
    pests: Pest[];
    [key: string]: unknown;
}

export default function CreatePestDetection({ districts, pests }: Props) {
    const [imagePreview, setImagePreview] = useState<string | null>(null);
    
    const { data, setData, post, processing, errors } = useForm<PestDetectionForm>({
        district_id: '',
        predicted_pest_id: '',
        image: null,
        latitude: '',
        longitude: '',
        confidence_score: '',
        notes: ''
    });

    const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            setData('image', file);
            
            const reader = new FileReader();
            reader.onload = (e) => {
                setImagePreview(e.target?.result as string);
            };
            reader.readAsDataURL(file);
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('pest-detections.store'));
    };

    const getCurrentLocation = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    setData({
                        ...data,
                        latitude: position.coords.latitude.toString(),
                        longitude: position.coords.longitude.toString()
                    });
                },
                (error) => {
                    console.error('Error getting location:', error);
                    alert('Unable to get your location. Please enter coordinates manually.');
                }
            );
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    };

    return (
        <>
            <Head title="Upload Pest Detection" />
            <AppShell>
                <div className="max-w-2xl mx-auto space-y-6">
                    {/* Header */}
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            📸 Upload Pest Detection
                        </h1>
                        <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Upload an image for AI-powered pest or disease detection
                        </p>
                    </div>

                    {/* Form */}
                    <div className="bg-white shadow rounded-lg dark:bg-gray-800">
                        <form onSubmit={handleSubmit} className="space-y-6 p-6">
                            {/* Image Upload */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    📷 Detection Image *
                                </label>
                                <div className="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md dark:border-gray-600">
                                    <div className="space-y-1 text-center">
                                        {imagePreview ? (
                                            <div className="space-y-2">
                                                <img
                                                    src={imagePreview}
                                                    alt="Preview"
                                                    className="mx-auto h-32 w-auto rounded"
                                                />
                                                <button
                                                    type="button"
                                                    onClick={() => {
                                                        setImagePreview(null);
                                                        setData('image', null);
                                                    }}
                                                    className="text-sm text-red-600 hover:text-red-500"
                                                >
                                                    Remove image
                                                </button>
                                            </div>
                                        ) : (
                                            <>
                                                <svg
                                                    className="mx-auto h-12 w-12 text-gray-400"
                                                    stroke="currentColor"
                                                    fill="none"
                                                    viewBox="0 0 48 48"
                                                >
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        strokeWidth={2}
                                                        strokeLinecap="round"
                                                        strokeLinejoin="round"
                                                    />
                                                </svg>
                                                <div className="flex text-sm text-gray-600">
                                                    <label className="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-green-500 dark:bg-gray-800">
                                                        <span>Upload a file</span>
                                                        <input
                                                            type="file"
                                                            accept="image/*"
                                                            className="sr-only"
                                                            onChange={handleImageChange}
                                                        />
                                                    </label>
                                                    <p className="pl-1">or drag and drop</p>
                                                </div>
                                                <p className="text-xs text-gray-500">
                                                    PNG, JPG up to 5MB
                                                </p>
                                            </>
                                        )}
                                    </div>
                                </div>
                                {errors.image && (
                                    <p className="mt-2 text-sm text-red-600">{errors.image}</p>
                                )}
                            </div>

                            {/* Location */}
                            <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        🌍 District
                                    </label>
                                    <select
                                        value={data.district_id}
                                        onChange={(e) => setData('district_id', e.target.value)}
                                        className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    >
                                        <option value="">Select District</option>
                                        {districts.map((district) => (
                                            <option key={district.id} value={district.id}>
                                                {district.name}, {district.regency.name}, {district.regency.province.name}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.district_id && (
                                        <p className="mt-1 text-sm text-red-600">{errors.district_id}</p>
                                    )}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        🐛 Predicted Pest (Optional)
                                    </label>
                                    <select
                                        value={data.predicted_pest_id}
                                        onChange={(e) => setData('predicted_pest_id', e.target.value)}
                                        className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    >
                                        <option value="">Let AI detect</option>
                                        {pests.map((pest) => (
                                            <option key={pest.id} value={pest.id}>
                                                {pest.type === 'pest' ? '🐛' : '🦠'} {pest.name}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.predicted_pest_id && (
                                        <p className="mt-1 text-sm text-red-600">{errors.predicted_pest_id}</p>
                                    )}
                                </div>
                            </div>

                            {/* GPS Coordinates */}
                            <div>
                                <div className="flex items-center justify-between mb-2">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        📍 GPS Coordinates (Optional)
                                    </label>
                                    <button
                                        type="button"
                                        onClick={getCurrentLocation}
                                        className="text-sm text-green-600 hover:text-green-500"
                                    >
                                        🎯 Use current location
                                    </button>
                                </div>
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <input
                                            type="number"
                                            step="any"
                                            placeholder="Latitude"
                                            value={data.latitude}
                                            onChange={(e) => setData('latitude', e.target.value)}
                                            className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        />
                                        {errors.latitude && (
                                            <p className="mt-1 text-sm text-red-600">{errors.latitude}</p>
                                        )}
                                    </div>
                                    <div>
                                        <input
                                            type="number"
                                            step="any"
                                            placeholder="Longitude"
                                            value={data.longitude}
                                            onChange={(e) => setData('longitude', e.target.value)}
                                            className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        />
                                        {errors.longitude && (
                                            <p className="mt-1 text-sm text-red-600">{errors.longitude}</p>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Confidence Score */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    🎯 AI Confidence Score (0-1, Optional)
                                </label>
                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    max="1"
                                    placeholder="0.85"
                                    value={data.confidence_score}
                                    onChange={(e) => setData('confidence_score', e.target.value)}
                                    className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                {errors.confidence_score && (
                                    <p className="mt-1 text-sm text-red-600">{errors.confidence_score}</p>
                                )}
                            </div>

                            {/* Notes */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    📝 Notes (Optional)
                                </label>
                                <textarea
                                    rows={3}
                                    placeholder="Additional observations or context..."
                                    value={data.notes}
                                    onChange={(e) => setData('notes', e.target.value)}
                                    className="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                />
                                {errors.notes && (
                                    <p className="mt-1 text-sm text-red-600">{errors.notes}</p>
                                )}
                            </div>

                            {/* Submit Button */}
                            <div className="flex justify-end space-x-3">
                                <button
                                    type="button"
                                    onClick={() => router.get(route('pest-detections.index'))}
                                    className="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    disabled={processing || !data.image}
                                    className="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    {processing ? '🔄 Uploading...' : '📸 Submit Detection'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </AppShell>
        </>
    );
}