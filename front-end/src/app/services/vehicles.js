import axios from 'axios';
import { env } from '../config/env';

const baseUrl = `${env.apiUrl}/api/vehicles`;

// Buscar todos os veículos com paginação
export const getAllVehicles = async (page = 1) => {
  const request = await axios.get(`${baseUrl}?page=${page}`);
  return request.data; 
};

export const addNewVehicle = async (vehicle) => {
  const request = await axios.post(baseUrl, vehicle);
  return request.data;
};

export const updateVehicle = async (vehicle, vehicleId) => {
  const request = await axios.put(`${baseUrl}/${vehicleId}`, vehicle);
  return request.data;
};

export const getVehicleById = async (vehicleId) => {
  const request = await axios.get(`${baseUrl}/${vehicleId}`);
  return request.data;
};

export const removeVehicle = async (vehicleId) => {
  const request = await axios.delete(`${baseUrl}/${vehicleId}`);
  return request.data;
};
