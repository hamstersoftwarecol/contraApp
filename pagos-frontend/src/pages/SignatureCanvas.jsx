import { useRef, useState, useEffect } from 'react';

function SignatureCanvas({ onSave, onCancel }) {
    const canvasRef = useRef(null);
    const [isDrawing, setIsDrawing] = useState(false);
    const [isEmpty, setIsEmpty] = useState(true);
    const lastPointRef = useRef(null);

    useEffect(() => {
        const canvas = canvasRef.current;
        const ctx = canvas.getContext('2d');

        // Set high DPI resolution for crisp lines
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();

        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;

        ctx.scale(dpr, dpr);

        // Set canvas styles for smooth drawing
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#1a1a1a';
        ctx.lineWidth = 2.5;
    }, []);

    const getCoordinates = (e) => {
        const canvas = canvasRef.current;
        const rect = canvas.getBoundingClientRect();

        if (e.touches && e.touches[0]) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        }

        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top
        };
    };

    const startDrawing = (e) => {
        e.preventDefault();
        const coords = getCoordinates(e);
        const ctx = canvasRef.current.getContext('2d');

        setIsDrawing(true);
        setIsEmpty(false);
        lastPointRef.current = coords;

        ctx.beginPath();
        ctx.moveTo(coords.x, coords.y);
    };

    const draw = (e) => {
        if (!isDrawing) return;
        e.preventDefault();

        const canvas = canvasRef.current;
        const ctx = canvas.getContext('2d');
        const coords = getCoordinates(e);
        const lastPoint = lastPointRef.current;

        // Use quadratic curves for smoother lines
        const midPoint = {
            x: (lastPoint.x + coords.x) / 2,
            y: (lastPoint.y + coords.y) / 2
        };

        ctx.quadraticCurveTo(lastPoint.x, lastPoint.y, midPoint.x, midPoint.y);
        ctx.stroke();

        lastPointRef.current = coords;
    };

    const stopDrawing = () => {
        setIsDrawing(false);
        lastPointRef.current = null;
    };

    const clearCanvas = () => {
        const canvas = canvasRef.current;
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        setIsEmpty(true);
    };

    const saveSignature = () => {
        if (isEmpty) {
            alert('Por favor dibuje su firma antes de guardar');
            return;
        }

        const canvas = canvasRef.current;
        const signatureData = canvas.toDataURL('image/png', 1.0);
        onSave(signatureData);
    };

    return (
        <div className="space-y-4">
            {/* Modern Canvas Container */}
            <div className="relative">
                <div className="backdrop-blur-sm bg-white rounded-2xl border-2 border-dashed border-indigo-300 p-1 shadow-xl">
                    <canvas
                        ref={canvasRef}
                        className="w-full h-48 md:h-56 cursor-crosshair touch-none rounded-xl bg-white"
                        style={{ touchAction: 'none' }}
                        onMouseDown={startDrawing}
                        onMouseMove={draw}
                        onMouseUp={stopDrawing}
                        onMouseLeave={stopDrawing}
                        onTouchStart={startDrawing}
                        onTouchMove={draw}
                        onTouchEnd={stopDrawing}
                    />
                </div>

                {/* Signature Line */}
                <div className="absolute bottom-8 left-8 right-8 border-b-2 border-gray-300 pointer-events-none">
                    <span className="absolute -bottom-6 left-0 text-xs text-gray-400">Firma aquí</span>
                </div>
            </div>

            {/* Instructions */}
            <div className="flex items-center justify-center gap-2 text-sm text-gray-600">
                <svg className="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <span>Dibuje su firma usando mouse, touchpad o pantalla táctil</span>
            </div>

            {/* Modern Action Buttons */}
            <div className="flex gap-3 justify-end">
                <button
                    type="button"
                    onClick={clearCanvas}
                    className="px-5 py-2.5 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 rounded-xl font-medium transition-all hover:shadow-md flex items-center gap-2"
                >
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Limpiar
                </button>
                <button
                    type="button"
                    onClick={onCancel}
                    className="px-5 py-2.5 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 rounded-xl font-medium transition-all hover:shadow-md flex items-center gap-2"
                >
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancelar
                </button>
                <button
                    type="button"
                    onClick={saveSignature}
                    className="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/50 hover:shadow-xl transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2"
                >
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Firma
                </button>
            </div>
        </div>
    );
}

export default SignatureCanvas;
